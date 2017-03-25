<?php

namespace Travel;

use Travel\Contract\ProductRepositoryInterface;

class InMemoryProductRepository implements ProductRepositoryInterface {

    private $products;

    public function __construct() {
        $this->products = [
            'milk'   => 1.15,
            'bread'  => 1.0,
            'butter' => 0.80,
        ];
    }

    /**
     * @param $name
     * @return null|Product
     */
    public function findByName($name) : ?Product {
        if (!array_key_exists($name, $this->products)) {
            return null;
        }

        return Product::namedAndPriced($name, $this->products[$name]);
    }
}