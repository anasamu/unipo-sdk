<?php

declare(strict_types=1);

namespace Unipo\Siakad\Laravel;

use Illuminate\Contracts\Cache\Factory as CacheFactory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Unipo\Siakad\Auth\Psr16TokenStore;
use Unipo\Siakad\Options;
use Unipo\Siakad\Siakad;

/**
 * Didaftarkan otomatis (package discovery). Menyediakan:
 *  - singleton Unipo\Siakad\Siakad (bisa di-inject di controller/job),
 *  - facade Siakad::mahasiswa()->getByNim(...),
 *  - token aplikasi disimpan di cache Laravel.
 */
final class SiakadServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/siakad.php', 'siakad');

        $this->app->singleton(Siakad::class, static function (Container $app): Siakad {
            /** @var array<string, mixed> $config */
            $config = (array) $app['config']->get('siakad', []);
            $storeName = $config['cache_store'] ?? null;
            unset($config['cache_store']);

            $cache = $app->make(CacheFactory::class)->store($storeName ?: null);
            $config['token_store'] = new Psr16TokenStore($cache);

            return new Siakad(Options::fromArray($config));
        });
        $this->app->alias(Siakad::class, 'siakad');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../../config/siakad.php' => $this->app->configPath('siakad.php')], 'siakad-config');
        }
    }

    /** @return list<string> */
    public function provides(): array
    {
        return [Siakad::class, 'siakad'];
    }
}
