<?php

namespace Travel\Offer;

use Travel\OfferInterface;
use Travel\Product;

class FourthMilkFree implements OfferInterface {

    use ProductCounter;

    private $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    // Buy 3 Milk and get the 4th milk for free

    public function calculateDiscount() :float
    {
        $evaluation = self::evaluate($this->products);

        $products = $evaluation['list'];
        $counter = $evaluation['counter'];

        if (array_key_exists('milk', $counter) && $counter['milk'] >= 4) {
            /** @var Product $milk */
            $milk = $products['milk'];
            $res = floor($counter['milk']/4);

            return $res * $milk->getPrice();
        }

        return 0.0;
    }
}