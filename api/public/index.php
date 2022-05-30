<?php

use Doctrine\ORM\EntityManager;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../bootstrap.php';

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

$container = new DI\Container();
$container->set(EntityManager::class, function($container) use ($entityManager) {
    return $entityManager;
});
AppFactory::setContainer($container);

$app = AppFactory::create();

$router_init = require __DIR__ . '/../router.php';

$router_init($app);

$app->run();
