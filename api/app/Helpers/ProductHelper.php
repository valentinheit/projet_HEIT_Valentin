<?php

namespace App\Helpers;

use Doctrine\ORM\EntityManager;
use Product;
use ProductPurchase;

class ProductHelper
{
    private EntityManager $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function stringifyProduct(Product $product): array {
        return [
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice()
        ];
    }

    public function parseProductPurchases(array $products): array {
        $result = [];
        
        foreach($products as $product) {
            $p = $this->getProductByName($product['name']);
            if ($p == null) continue;

            $quantity = $product["quantity"] ?? 0;
            if ($quantity <= 0) continue;

            $productPurchase = new ProductPurchase();
            $productPurchase->setProduct($p);
            $productPurchase->setQuantity($quantity);
            $productPurchase->setPrice($p->getPrice());

            array_push($result, $productPurchase);            
        }

        return $result;
    }

    public function getProductByName(string $productName): ?Product {
        $productRepo = $this->em->getRepository('Product');
        $product = $productRepo->findOneBy([
            'name' => $productName,
        ]);

        return $product;
    }

}