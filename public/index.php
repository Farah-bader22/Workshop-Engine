<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/**
 * --------------------------------------------------------------------------
 * جسر عبور الصور (اللمسة القاضية لفك حظر الـ 403)
 * --------------------------------------------------------------------------
 * هذا الكود يقرأ الصور من المجلد ويرسلها للمتصفح مباشرة كبيانات خام،
 * مما يتخطى قيود الصلاحيات التي يفرضها ويندوز على الروابط.
 */
if (strpos($_SERVER['REQUEST_URI'], '/uploads/') !== false) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = __DIR__ . $uri;

    if (file_exists($path) && !is_dir($path)) {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $mimes = [
            'png'  => 'image/png',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif'  => 'image/gif',
            'webp' => 'image/webp',
            'mp4'  => 'video/mp4'
        ];

        $contentType = $mimes[strtolower($extension)] ?? 'application/octet-stream';
        header("Content-Type: $contentType");
        header("Access-Control-Allow-Origin: *");
        readfile($path);
        exit;
    }
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
