<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

$isDevMode = true;
$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'host' => $_ENV['DB_HOST'],
    'driver' => 'pdo_pgsql',
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'dbname' => $_ENV['DB_NAME'],
    'port' => $_ENV['DB_PORT']
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);