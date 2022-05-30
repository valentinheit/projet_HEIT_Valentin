<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Tuupola\Middleware\HttpBasicAuthentication;
use \Firebase\JWT\JWT;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
date_default_timezone_set('America/Lima');
require_once "vendor/autoload.php";
$isDevMode = true;
$config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/config/yaml"), $isDevMode);
$conn = array(
'host' => 'ec2-3-248-4-172.eu-west-1.compute.amazonaws.com',
'driver' => 'pdo_pgsql',
'user' => 'lmcibctugyfgla',
'password' => 'xxx',
'dbname' => 'd8jrr50unmfhsl',
'port' => '5432'
);
$entityManager = EntityManager::create($conn, $config);


const JWT_SECRET = "V4LENTIN";
$app = AppFactory::create();

function createJWT(Response $response) : Response{
    $issuedAt = time();
    $expirationTime = $issuedAt + 600;
    $payload = array(
    'userid' => 'valentin',
    'email' => 'heit.valentin@icloud.com',
    'pseudo' => 'valentin',
    'iat' => $issuedAt,
    'exp' => $expirationTime
    );

    

    $token_jwt = JWT::encode($payload, JWT_SECRET, "HS256");
    $response = $response->withHeader("Authorization", "Bearer {$token_jwt}");
    return $response;
}

$app->get('/api/hello/{name}', function (Request $request, Response $response, $args) {
    $array = [];
    $array ["nom"] = $args ['name'];
    $response->getBody()->write(json_encode ($array));
    return $response;
});

$app->get('/api/user', function(Request $request, Response $response, $args){
    $data = ['name' => "Heit", "firstName" => "Valentin", "Address" => "32 rue de Soultz"];
    $response->getBody()->write(json_encode($data));
    return $response;
});

$app->get('/api/catalogue/{filtre}', function(Request $request, Response $response, $args) {
    $filtre = $args['filtre'];
    $flux = '[{"titre": "linux", "ref": "001", "prix": "20"}, {"titre":"java", "ref:"002", "prix": "21"}]';

    if($filtre){
        $data = json_decode($flux, true);

        $res = array_filter($data, function($obj) use ($filtre){
            return strpos($obj["titre"], $filtre) !== false;
        });
        $response->getBody()->write(json_encode(array_values($res)));
    }
    else{
        $response->getBody()->write($flux);
    }
    return $response;
});


$app->post('/api/login', function (Request $request, Response $response, $args) {
    $err = false;
    $body = $request->getParsedBody();
    $login = $body['login'] ?? "";
    $pass = $body ['pass'] ?? ""; 

    if(!preg_match("/[a-zA-z0-9]{1,20}/", $login)){
        $err = true;
    }
    if(!preg_match("/[a-zA-z0-9]{1,20}/", $pass)){
        $err = true;
    }

    if(!$err){
        // $userRepository = $entityManager->getRepository('User');
        // $user = $userRepository->findOneBy(['login' => $login, 'password' => $pass]);
        // if($user and $login == $user->getLogin() and $pass == $user->getPassword()){
        //     $response = addHeaders($response, $request->getHeader('Origin'));
        //     $response = createJWT($response);
        //     $data = ["name" => $user->getName(), 'firstName' => $user->getFirstName()];
        //     $response->getBody()->write(json_encode($data));
        // }
        // else{
        //     $response = $response->withStatus(401);
        // }
        $response = createJWT($response);
        $data = ['name' => 'Heit', 'firstName' => 'Valentin'];
        $response->getBody()->write(json_encode($data));
    }
    else{
        $response = $response->withStatus(401);
    }
    return $response;
});



$options = [
    "attribute" => "token",
    "header" => "Authorization",
    "regexp" => "/Bearer\s+(.*)$/i",
    "secure" => false,
    "algorithm" => ["HS256"],
    "secret" => JWT_SECRET, 
    "path" => ["/api"], 
    "ignore" => ["/api/hello", "/api/login", "/api/createUser"],
    "error" => function($response, $args){
        $data = ["ERROR" => 'Connection', 'ERROR' => 'Invalid JWT'];
        $response = $response->withStatus(401);
        return $response->withHeader('Content-Type', "application/json")->getBody()->write(json_encode($data));
    }
];
$app->add(new
Tuupola\Middleware\JwtAuthentication($options));
$app->run();