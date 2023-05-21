<?php
use app\controllers\SiteController;
use app\core\Application;

require_once __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'plp']);
$app->router->get('/add-product', [SiteController::class, 'addProduct']);
$app->router->post('/add-product', [SiteController::class, 'addProduct']);
$app->router->post('/mass-delete', [SiteController::class, 'massDelete']);

$app->router->post('/add-attribute-section', [SiteController::class, 'addAttributeSection']);
$app->run();