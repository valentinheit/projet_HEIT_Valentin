<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\App;
use Tuupola\Middleware\JwtAuthentication;

use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\OrderController;
use App\Middlewares\CorsMiddleware;
use App\Controllers\ErrorController;

return function(App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        return $response;
    });
    
    $app->add(CorsMiddleware::class);

    $app->group('/users', function(Group $group) {
        $group->post('/login', UserController::class . ':login');
        $group->post('/register', UserController::class . ':register');
        $group->get('/account', UserController::class . ':getUser');
        $group->post('/order', OrderController::class . ':order');

        $group->group('/purchases', function(Group $grp) {
            $grp->get('/history', OrderController::class . ':history');
            $grp->get('/detail/{order_id}', OrderController::class . ':detail');
            $grp->get('/get/{order_id}', OrderController::class . ':get');
        });
    });

    $app->group('/products', function(Group $group) {
        $group->get('/all', ProductController::class . ':all');
    });

    $options = [
        "attribute" => "token",
        "header" => "Authorization",
        "regexp" => "/Bearer\s+(.*)$/i",
        "secure" => false,
        "algorithm" => ["HS256"],
        "secret" => $_ENV['JWT_SECRET'],
        "path" => ["/"],
        "ignore" => ["/users/register","/users/login", "/products"],
        "error" => function ($response, $arguments) {
            $data = array('ERREUR' => 'Connexion', 'ERREUR' => 'JWT Non valide');
            $response = $response->withStatus(401);
            return $response->withHeader("Content-Type", "application/json")->getBody()->write(json_encode($data));
        }
    ];

    $app->add(new JwtAuthentication($options));

    // Error routing
    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorMiddleware->setDefaultErrorHandler((new ErrorController())->getHandlerFunction($app));
};

