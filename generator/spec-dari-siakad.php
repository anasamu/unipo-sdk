<?php

/*
 * Membuat ulang openapi.json dari kode SIAKAD (tanpa server dan tanpa database).
 *
 *   php generator/spec-dari-siakad.php /path/ke/siakad_unipo > openapi.json
 *
 * Isinya sama dengan GET /v1/openapi.json di server, karena memakai kelas OpenApi yang sama.
 * Alternatif tanpa kode SIAKAD: curl -s https://api.unipo.ac.id/v1/openapi.json > openapi.json
 */

declare(strict_types=1);

$root = rtrim($argv[1] ?? '', '/');
if ($root === '' || !is_file($root . '/src/Api/Docs/OpenApi.php')) {
    fwrite(STDERR, "Pemakaian: php spec-dari-siakad.php /path/ke/siakad_unipo > openapi.json\n");
    exit(1);
}

define('SIAKAD_ROOT', $root);
require $root . '/vendor/autoload.php';

use Siakad\Api\Docs\OpenApi;
use Siakad\Api\Support\ApiModules;

$routes = array_merge(require $root . '/app/Modules/Api/api_routes.php', ApiModules::routes());
$config = require $root . '/config/api.php';
$scopes = ApiModules::scopes() + (array) ($config['scopes'] ?? []);
$schemas = (require $root . '/app/Modules/Api/Docs/schemas.php') + ApiModules::schemas();

echo json_encode(
    OpenApi::build($routes, $scopes, $schemas, 'https://siakad.unipo.ac.id/api', 'SIAKAD UNIPO', 'https://api.unipo.ac.id'),
    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
), "\n";
