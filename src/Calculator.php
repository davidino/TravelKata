<?php

namespace Travel;

class Calculator {

    private $total;

    public function __construct(Basket $basket, array $offers)
    {
        foreach ($offers as $offer) {
            if (!in_array(OfferInterface::class, class_implements($offer))) {
                throw new \InvalidArgumentException('The Class ' . $offer . ' does not implement the OfferInterface');
            }
        }

        $this->total = 0;

        $total = 0.0;
        $discount = 0.0;

        /** @var Product $product */
        foreach($basket->getProducts() as $product) {
            $total += $product->getPrice();
        }

        foreach ($offers as $offer) {
            /** @var OfferInterface $off */
            $off = new $offer($basket->getProducts());
            $discount += $off->calculateDiscount();
        }

        $this->total = $total - $discount;
    }

    public static function calculate(Basket $basket, array $offers)
    {
        return new self($basket, $offers);
    }

    public function getTotal() {
        return $this->total;
    }
}

