<?php

require '../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/utils.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Tuupola\Middleware\JwtAuthentication;
use Slim\Factory\AppFactory;

$app = AppFactory::create();


$app->post('/api/signup', function(Request $request, Response $response, $args){
    $body = $request->getParsedBody();
    $email = $body['email'] ?? "";
    $password = $body['password'] ?? "";
    $prenom = $body['prenom'] ?? "";
    $nom = $body['nom'] ?? "";

    $err = $email == "" || $password == "" || $login == "" || $nom == "" || $prenom == "";
    if ($err) {
        $data["error"] = "Error with the accounts field";
        $response = $response->withStatus(403);
        $response->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        return $response;
    }

    $clientRespository = Config::getInstance()->entityManager->getRepository('Client');
    $client = $clientRespository->findOneBy(array("email" => $email));
    if ($client != null) {
        // Client déjà existant avec cet email
        $data["error"] = "Error creating the account";
        $response = $response->withStatus(403);
        $response->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        return $response;
    }

    $newClient = new Client();
    $newClient->setEmail($email);
    $newClient->setPrenom($prenom);
    $newClient->setNom($nom);
    $newClient->setPassword(password_hash($password, PASSWORD_DEFAULT));
    Config::getInstance()->entityManager->persist($newClient);
    Config::getInstance()->entityManager->flush();

    $data["email"] = $email;
    $response = addHeaders($response);
    $response = $response->withHeader("Access-Control-Max-Age", 600);
    $response->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

    return $response;
});

// POST /api/login
$app->post('/api/login', function(Request $request, Response $response, $args) {
    $body = $request->getParsedBody();
    $login = $body['email'] ?? "";
    $password = $body['password'] ?? "";

    $err = $login == "" || $password == "";
    if ($err) {
        // Problème avec les champs
        $data["error"] = "Error with the accounts field";
        $response = $response->withStatus(403);
        $response->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        return $response;
    }

    $clientRespository = Config::getInstance()->entityManager->getRepository('Client');
    $client = $clientRespository->findOneBy(array("email" => $email));
    if ($client == null || !password_verify($password, $client->getPassword())) {
        // Aucun client avec cet email / mdp
        $data["error"] = "Error with the email or password";
        $response = $response->withStatus(403);
        $response->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        return $response;
    }

    $data["email"] = $client->getEmail();
    $data["login"] = $client->getLogin();
    $data["prenom"] = $client->getPrenom();
    $data["nom"] = $client->getNom();
    $data["expiration_time"] = time() + 600;
    $response = addHeaders($response);
    $response = createJWT($response, $login);
    $response->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

    return $response;
});

// GET /api/products
$app->get('/api/products', function(Request $request, Response $response, $args) {
    $productRepository = Config::getInstance()->entityManager->getRepository('Product');
    $products = $productRepository->findAll();

    $data = array();
    foreach($products as $product) {
        $productInfo = array(
            "id" => $product->getId(),
            "libelle" => $product->getLibelle(),
            "prix" => $product->getPrix()
        );
        array_push($data, $productInfo);
    }

    $response = addHeaders($response);
    $response->getBody()->write(json_encode($data));
    return $response;
});

$app->add(new JwtAuthentication(Config::getInstance()->options));

$app->run();

