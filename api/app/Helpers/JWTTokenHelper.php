<?php

namespace App\Helpers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;

class JWTTokenHelper {

    public static function generateJWTToken(string $user_login) {
        $issuedAt = time();

        $payload = [
            'iat' => $issuedAt,
            'exp' => $issuedAt + 60,
            'user_login' => $user_login
        ];

       return JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');
    }

    public static function decodeJWTToken(string $header): array {
        $arr = explode(' ', $header);

        if (count($arr) != 2) return [];

        $jwt = $arr[1];

        return (array)JWT::decode($jwt, $_ENV['JWT_SECRET'], array('HS256'));
    }

    public static function getLoginFromAuth(Request $request): string {
        $authHeader = $request->getHeaderLine('authorization');
        return JWTTokenHelper::decodeJWTToken($authHeader)['user_login'] ?? '';
    }
}