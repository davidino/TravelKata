<?php

namespace Travel;

class Cart {
    private $products;
    private $total;
    private $repo;
    private $offers;

    public function __construct(ProductRepositoryInterface $repo, array $offers = [], array $products = [])
    {
        $this->repo = $repo;
        $this->total = 0;

        foreach ($offers as $offer) {
            if (!in_array(OfferInterface::class, class_implements($offer))) {
                throw new \InvalidArgumentException('The Class ' . $offer . ' does not implement the OfferInterface');
            }
            $this->offers[] = $offer;
        }

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
     * @return float
     */
    public function calculateTotal() : float {
        $discount = 0.0;

        /** @var Product $product */
        foreach($this->products as $product) {
            $this->total += $product->getPrice();
        }

        foreach ($this->offers as $offer) {
            /** @var OfferInterface $off */
            $off = new $offer($this->products);
            $discount += $off->calculateDiscount();
        }

        $this->total = $this->total - $discount;

        return $this->total;
    }

    /**
     * @return float
     */
    public function getTotal(): float {
        return $this->total;
    }

    /**
     * @return array
     */
    public function getProducts() : array {
        return $this->products;
    }
}