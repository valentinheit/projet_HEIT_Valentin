<?php

use Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;

const JWT_SECRET = "8cc48746-6212-4e7d-b370-3226d7f86405";
const JWT_EXPIRATION_TIME = 600;

function createJWT(Response $response, String $username) : Response {
    $issuedAt = time();
    $expirationTime = $issuedAt + JWT_EXPIRATION_TIME;
    $payload = array(
        'username' => $username,
        'iat' => $issuedAt,
        'exp' => $expirationTime
    );

    $token_jwt = JWT::encode($payload, JWT_SECRET, "HS256");
    $response = $response->withHeader("Authorization", "Bearer {$token_jwt}");
    return $response;
}

function addHeaders(Response $response) : Response {
    $response = $response->withHeader("Content-Type", "application/json")
        ->withHeader("Access-Control-Allow-Origin", "https://projet-heit-valentin.herokuapp.com")
        ->withHeader("Access-Control-Allow-Headers", "Content-Type, Authorization")
        ->withHeader("Access-Control-Allow-Methods", "GET, POST, PUT, PATCH, DELETE, OPTIONS")
        ->withHeader("Access-Control-Expose-Headers", "Authorization");

    return $response;
}