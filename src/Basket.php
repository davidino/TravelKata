<?php

namespace Travel;

class Basket {
    private $products;
    private $repo;

    public function __construct(ProductRepositoryInterface $repo, array $products = [])
    {
        $this->repo = $repo;

        foreach ($products as $productName) {
            if (! ($product = $repo->findByName($productName))) {
                throw new \InvalidArgumentException('Cannot find the product ' . $productName );
            }

            $this->products[] = $product;
        }
    }

    /**
     * @param string $productName
     * @param int $qty
     */
    public function add(string $productName, int $qty = 1) {

        $product = $this->repo->findByName($productName);
        if (!$product) {
            throw new \InvalidArgumentException('the product does not exist: '. $productName);
        }

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