<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\ORM\EntityManager;

use App\Helpers\JWTTokenHelper;

class UserController
{
    private EntityManager $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function login(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $login = $data['login'] ?? "";
        $password = $data['password'] ?? "";

        if (!preg_match("/[a-zA-Z0-9]{1,256}/",$login))   {
            return $response
            ->withStatus(400);
        }
        if (!preg_match("/[a-zA-Z0-9]{1,256}/",$password))  {
            return $response
            ->withStatus(400);
        }

        $clientRepo = $this->em->getRepository('Client');
        $client = $clientRepo->findOneBy([
            'login' => $login,
        ]);

        if ($client == null || !password_verify($password, $client->getPassword())) {
            $response->getBody()->write(json_encode(['success' => false]));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }

        $token_jwt = JWTTokenHelper::generateJWTToken($login);

        $response->getBody()->write(json_encode([
            'success' => true,
            'login' => $login 
            ]));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Authorization', 'Bearer ' . $token_jwt)
            ->withStatus(200);
    }

    public function register(Request $request, Response $response, array $args): Response
    {
        $body = $request->getParsedBody();
        $json = $body['account'] ?? "";
        $data = json_decode($json, true);

        $lastname = $data['lastname'] ?? "";
        $firstname = $data['firstname'] ?? "";
        $civility = $data['civility'] ?? "";
        $phone = $data['phone'] ?? "";
        $email = $data['email'] ?? "";
        $login = $data['login'] ?? "";
        $password = $data['password'] ?? "";
        $address = $data['address'] ?? [];
        $street = $address['street'] ?? "";
        $zipCode = $address['zipCode'] ?? "";
        $city = $address['city'] ?? "";
        $country = $address['country'] ?? "";
        

        if (!preg_match("/[a-zA-Z]{1,256}/",$lastname)) return $response->withStatus(400);
        if (!preg_match("/[a-zA-Z]{1,256}/",$firstname)) return $response->withStatus(400);
        if (!preg_match("/[a-zA-Z]{1,30}/",$civility)) return $response->withStatus(400);
        if (!preg_match("/[+0-9 ]{17}/",$phone)) return $response->withStatus(400);
        if (!preg_match("/[a-zA-Z0-9@.]{1,256}/",$email)) return $response->withStatus(400);
        if (!preg_match("/[a-zA-Z0-9]{1,256}/",$login)) return $response->withStatus(400);
        if (!preg_match("/[a-zA-Z0-9]{1,256}/",$password)) return $response->withStatus(400);
        if (!preg_match("/[a-zA-Z0-9]{1,256}/",$street)) return $response->withStatus(400);
        if (!preg_match("/[0-9]{5}/",$zipCode)) return $response->withStatus(400);
        if (!preg_match("/[a-zA-Z]{1,256}/",$city)) return $response->withStatus(400);
        if (!preg_match("/[a-zA-Z]{1,256}/",$country)) return $response->withStatus(400);

        $clientRepo = $this->em->getRepository('Client');
        $client = $clientRepo->findOneBy([
            'login' => $login,
        ]);
        
        if ($client != null) return $response->withStatus(400);

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        if (!$passwordHash) return $response->withStatus(400);

        $user = new \Client;

        $user->setLastname($lastname);
        $user->setFirstname($firstname);
        $user->setCivility($civility);
        $user->setPhone($phone);
        $user->setEmail($email);
        $user->setStreet($street);
        $user->setZipCode($zipCode);
        $user->setCity($city);
        $user->setCountry($country);
        $user->setLogin($login);
        $user->setPassword($passwordHash);
        $this->em->persist($user);
        $this->em->flush();

        $response->getBody()->write(json_encode([
            'success' => true,
            'login' => $login
            ]));

        $token_jwt = JWTTokenHelper::generateJWTToken($login);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Authorization', 'Bearer ' . $token_jwt)
            ->withStatus(200);
    }

    public function getUser(Request $request, Response $response, array $args): Response
    {
        $login = JWTTokenHelper::getLoginFromAuth($request);

        if (!preg_match("/[a-zA-Z0-9]{1,256}/",$login)) return $response->withStatus(400);

        $clientRepo = $this->em->getRepository('Client');
        $client = $clientRepo->findOneBy([
            'login' => $login,
        ]);

        if ($client == null) {
            $response->getBody()->write(json_encode(['success' => false]));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }

        $result = [
            'lastname' => $client->getLastname(),
            'firstname' => $client->getFirstname(),
            'civility' => $client->getCivility(),
            'address' => [
                'street' => $client->getStreet(),
                'zipCode' => $client->getZipCode(),
                'city' => $client->getCity(),
                'country' => $client->getCountry(),
            ],
            'email' => $client->getEmail(),
            'phone' => $client->getPhone(),
            'login' => $client->getLogin()
        ];

        $response->getBody()->write(json_encode($result));

        $token_jwt = JWTTokenHelper::generateJWTToken($login);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Authorization', 'Bearer ' . $token_jwt)
            ->withStatus(200);
    }  
}