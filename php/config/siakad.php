<?php

/*
 * Pengaturan SDK API SIAKAD UNIPO untuk Laravel.
 * Terbitkan ke aplikasi: php artisan vendor:publish --tag=siakad-config
 */

return [
    // Alamat dasar API tanpa /v1. Alamat lama https://siakad.unipo.ac.id/api juga bisa dipakai.
    'base_url' => env('SIAKAD_BASE_URL', 'https://api.unipo.ac.id'),

    // Kredensial aplikasi dari portal api.unipo.ac.id (Aplikasi saya) atau admin SIAKAD.
    'client_id' => env('SIAKAD_CLIENT_ID'),
    'client_secret' => env('SIAKAD_CLIENT_SECRET'),

    // Scope token aplikasi, dipisah spasi. Kosong = semua scope klien.
    'scope' => env('SIAKAD_SCOPE'),

    // "development" untuk memaksa database development walau klien sudah punya akses live.
    'environment' => env('SIAKAD_ENVIRONMENT'),

    'timeout' => (float) env('SIAKAD_TIMEOUT', 30),
    'max_retries' => (int) env('SIAKAD_MAX_RETRIES', 2),

    // Nyalakan bila hosting menolak PUT/PATCH/DELETE (403/405 dari server web).
    'method_override' => (bool) env('SIAKAD_METHOD_OVERRIDE', false),

    // Store cache untuk menyimpan token aplikasi (null = store bawaan aplikasi).
    'cache_store' => env('SIAKAD_CACHE_STORE'),
];
