<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

date_default_timezone_set('America/Lima');
const JWT_SECRET = "azerty123456789";

class Config {
    private static ?Config $instance = null;
    public ?EntityManager $entityManager = null;
    public Mixed $options = null;

    private function __construct()
    {
        $isDevMode = true;
        $config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/config/yaml"), $isDevMode);
        $conn = array(
            'host' => 'ec2-44-196-223-128.compute-1.amazonaws.com',
            'driver' => 'pdo_pgsql',
            'user' => 'dttnablpbyyagr',
            'password' => 'be0ed1a0374c981a182ac2330b1b57ad38512f61fe5880cdff05c22f872bb66f',
            'dbname' => 'd3enmh3mt3n9uf',
            'port' => '5432'
        );
        $this->entityManager = EntityManager::create($conn, $config);

        $this->options = [
            "attribute" => "token",
            "header" => "Authorization",
            "regexp" => "/Bearer\s+(.*)$/i",
            "secure" => false,
            "algorithm" => ["HS256"],
            "secret" => JWT_SECRET,
            "path" => ["/api"],
            "ignore" => ["/api/login", "/api/signin"],
            "error" => function ($response, $arguments) {
                $data["status"] = "error";
                $data["message"] = $arguments["message"];
                return $response
                    ->withHeader("Content-Type", "application/json")
                    ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            }
        ];
    }

    public static function getInstance() : Config {
        if (self::$instance == null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

}


