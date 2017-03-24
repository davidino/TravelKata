<?php

namespace Travel;

class Cart {
    private $products;
    private $total;
    private $repo;

    public function __construct(ProductRepository $repo, array $products = [])
    {
        $this->repo = $repo;

        foreach ($products as $product) {
            if (!$product instanceof Product) {
                throw new \InvalidArgumentException('You can pass only Product objects');
            }

            if (!$repo->findByName($product->getName())) {
                throw new \InvalidArgumentException('Cannot find this product');
            }
        }

        $this->products = $products;

    }

    /**
     * @param Product $product
     * @param int $qty
     */
    public function add(Product $product, $qty = 1) {

        if (!$this->repo->findByName($product->getName())) {
            throw new \InvalidArgumentException('the product does not exist: '. $product->getName());
        }

        while($qty > 0) {
            $this->products[] = $product;
            $qty--;
        }
    }

    /**
     * @return float
     */
    public function calculateTotal() : float {
        $total = 0;

        /** @var Product $product */
        foreach($this->products as $product) {
            $price = $this->repo->getPriceByName($product->getName());
            $total += $price;
        }

        $this->total =  $total;

        return $total;
    }

    public function getTotal(){
        return $this->total;
    }
}