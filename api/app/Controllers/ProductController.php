<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\ORM\EntityManager;
use App\Helpers\ProductHelper;

class ProductController
{
    private EntityManager $em;
    private ProductHelper $productHelper;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->productHelper = new ProductHelper($em);
    }

    public function all(Request $request, Response $response, array $args): Response {
        $productRepo = $this->em->getRepository('Product');

        $productsRaw = $productRepo->findAll();
        $products = array();

        foreach($productsRaw as $product) array_push($products, $this->productHelper->stringifyProduct($product));

        $response->getBody()->write(json_encode($products));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}