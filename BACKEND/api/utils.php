<?php

use Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;

const JWT_SECRET = "azerty123456789";

function createJWT(Response $response, String $login) : Response {
    $issuedAt = time();
    $expirationTime = $issuedAt + 600;
    $payload = array(
        'login' => $login,
        'iat' => $issuedAt,
        'exp' => $expirationTime
    );

    $token_jwt = JWT::encode($payload, JWT_SECRET, "HS256");
    $response = $response->withHeader("Authorization", "Bearer {$token_jwt}");
    return $response;
}

function addHeaders(Response $response) : Response {
    $response = $response->withHeader("Content-Type", "application/json")
        ->withHeader("Access-Control-Allow-Origin", "http://projet-heit-valentin.herokuapp.com")
        ->withHeader("Access-Control-Allow-Headers", "Content-Type, Authorization")
        ->withHeader("Access-Control-Allow-Methods", "GET, POST, PUT, PATCH, DELETE, OPTIONS")
        ->withHeader("Access-Control-Expose-Headers", "Authorization");

    return $response;
}