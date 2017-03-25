<?php

namespace Travel;

class Basket implements BasketInterface {
    private $products = [];

    public function __construct(array $products = [])
    {
        foreach ($products as $product) {
            if (!$product instanceof Product) {
                throw new \InvalidArgumentException('Must provide a Product object');
            }
            $this->products[] = $product;
        }
    }

    public static function initializeEmtpy() {
        return new self([]);
    }

    public static function initializeWithProducts($products) {
        return new self($products);
    }

    /**
     * @param Product $product
     * @param int $qty
     */
    public function add(Product $product, int $qty = 1) {
        while($qty > 0) {
            $this->products[] = $product;
            $qty--;
        }
    }

    /**
     * @return array
     */
    public function getProducts() : array {
        return $this->products;
    }
}