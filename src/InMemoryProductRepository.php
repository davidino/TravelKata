<?php

namespace Travel;

use Travel\Contract\ProductRepositoryInterface;

class InMemoryProductRepository implements ProductRepositoryInterface {

    private $products;

    public function __construct(array $products) {

        foreach ($products as $product) {
            if(!$product instanceof Product) {
                throw new \InvalidArgumentException('Provide Product instance');
            }
            $this->products[$product->getName()] = $product;
        }
    }

    public function add(Product $product) {
        $this->products[$product->getName()][] = $product;
    }

    /**
     * @param $name
     * @return null|Product
     */
    public function findByName(string $name) : ?Product {
        if (!array_key_exists($name, $this->products)) {
            return null;
        }

        return $this->products[$name];
    }


}