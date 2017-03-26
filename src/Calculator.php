<?php

namespace Travel;

class Calculator {

    private $total;

    public function __construct(BasketInterface $basket, DiscountCalculator $discountCalculator = null)
    {
        $this->total = 0;
        $discount = 0;

        /** @var Product $product */
        foreach($basket->getProducts() as $product) {
            $this->total += $product->getPrice();
        }

        if ($discountCalculator) {
            $discount = $discountCalculator->handle($basket);
        }

        $this->total -= $discount;
    }

    public static function calculate(BasketInterface $basket, DiscountCalculator $discountCalculator = null)
    {
        return new self($basket, $discountCalculator);
    }

    public function getTotal() {
        return $this->total;
    }
}

