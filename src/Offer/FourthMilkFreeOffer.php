<?php

namespace Travel\Offer;

use Travel\OfferInterface;
use Travel\Product;

class FourthMilkFreeOffer implements OfferInterface {

    use ProductCounter;

    // Buy 3 Milk and get the 4th milk for free

    public static function calculateDiscount(array $products) :float
    {
        $evaluation = self::evaluate($products);

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