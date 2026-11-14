<?php

declare(strict_types=1);

namespace Unipo\Siakad\Auth;

use Unipo\Siakad\Http\ApiResponse;
use Unipo\Siakad\Siakad;

/** Autentikasi OAuth 2.0 API SIAKAD (/v1/auth/*). */
final class AuthApi
{
    public function __construct(private readonly Siakad $client)
    {
    }

    /**
     * Token aplikasi (server ke server). Biasanya tidak perlu dipanggil: SDK meminta dan menyimpan token ini otomatis.
     *
     * @param string|list<string>|null $scope
     */
    public function clientCredentials(string|array|null $scope = null): TokenSet
    {
        $params = ['grant_type' => 'client_credentials'];
        $scope = is_array($scope) ? implode(' ', $scope) : (string) $scope;
        if ($scope !== '') {
            $params['scope'] = $scope;
        }

        return $this->client->requestToken($params);
    }

    /**
     * Login pengguna dengan username (NIM/NIDN/username) dan password SIAKAD. Klien harus diizinkan login pengguna.
     * Pakai hasilnya dengan $siakad->withToken($token).
     *
     * @param string|list<string>|null $scope
     * @param string|null $userIp IP pengguna akhir (hanya untuk klien "percayai IP pengguna")
     */
    public function password(string $username, string $password, string|array|null $scope = null, ?string $userIp = null): TokenSet
    {
        $params = ['grant_type' => 'password', 'username' => $username, 'password' => $password];
        $scope = is_array($scope) ? implode(' ', $scope) : (string) $scope;
        if ($scope !== '') {
            $params['scope'] = $scope;
        }

        return $this->client->requestToken($params, $userIp);
    }

    /** Tukar refresh token (sekali pakai) dengan pasangan token baru. */
    public function refresh(string $refreshToken): TokenSet
    {
        return $this->client->requestToken(['grant_type' => 'refresh_token', 'refresh_token' => $refreshToken]);
    }

    /**
     * Tukar id_token dari SSO UNIPO (sso.unipo.ac.id) menjadi token pengguna SIAKAD (RFC 8693).
     * Klien API harus ditandai dengan client ID aplikasi di SSO.
     */
    public function exchangeSsoToken(string $idToken): TokenSet
    {
        return $this->client->requestToken([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:token-exchange',
            'subject_token_type' => 'urn:ietf:params:oauth:token-type:id_token',
            'subject_token' => $idToken,
        ]);
    }

    /**
     * Informasi token yang sedang dipakai: client_id, client_name, token_type, scopes, expires_at, dan untuk token
     * pengguna username, level, nama, email, prodi, peran.
     *
     * @return array<string, mixed>
     */
    public function me(): array
    {
        return (array) $this->client->send('GET', '/v1/auth/me', [], [], null, [], false, false)->data();
    }

    /** Cabut token yang sedang dipakai (logout). Sertakan refresh token agar ikut dicabut. */
    public function revoke(?string $refreshToken = null): ApiResponse
    {
        $body = $refreshToken !== null ? ['refresh_token' => $refreshToken] : [];

        return $this->client->send('POST', '/v1/auth/revoke', [], [], $body, [], false, false);
    }

    /**
     * Lupa password: minta token reset (khusus klien perantara login tepercaya, mis. SSO).
     *
     * @return array<string, mixed> berisi sent, dan email + token bila akun punya email
     */
    public function forgotPassword(string $username, string $userIp): array
    {
        return (array) $this->client->send('POST', '/v1/auth/password/forgot', [], [], $this->withClient(['username' => $username]), ['headers' => ['X-Siakad-User-Ip' => $userIp]], false, true)->data();
    }

    /**
     * Simpan password baru dengan token reset (minimal 8 karakter, tidak sama dengan username).
     *
     * @return array<string, mixed>
     */
    public function resetPassword(string $username, string $token, string $password, string $userIp): array
    {
        $body = $this->withClient(['username' => $username, 'token' => $token, 'password' => $password]);

        return (array) $this->client->send('POST', '/v1/auth/password/reset', [], [], $body, ['headers' => ['X-Siakad-User-Ip' => $userIp]], false, true)->data();
    }

    /**
     * @param array<string, string> $body
     * @return array<string, string>
     */
    private function withClient(array $body): array
    {
        return ['client_id' => (string) $this->client->options->clientId, 'client_secret' => (string) $this->client->options->clientSecret] + $body;
    }
}
