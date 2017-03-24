<?php

namespace Travel;

class ProductRepository {

    private $products;

    public function __construct() {
        $this->products = [
            'milk'   => 1.15,
            'bread'  => 1.0,
            'butter' => 0.80,
        ];
    }

    public function findByName($name) {
        return array_key_exists($name, $this->products);
    }

    public function getPriceByName($name) {
        if (!array_key_exists($name, $this->products)) {
            return null;
        }

        return $this->products[$name];
    }
}