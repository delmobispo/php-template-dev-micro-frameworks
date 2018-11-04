<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}
require __DIR__ . '/vendor/autoload.php';

use App\Configs\RoutesConfig;
use App\Configs\SlimConfig;
use App\Configs\ControllersConfig;
use App\Configs\MiddlewaresConfig;

$settings = new SlimConfig();
$app = $settings->getApp();
$container = $settings->getContainer();
$controllers = new ControllersConfig($container);
$routes = new RoutesConfig($app);
$middlewares = new MiddlewaresConfig($app);

$app->run();