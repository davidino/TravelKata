<?php

namespace Travel\Offer;

use Travel\BasketInterface;
use Travel\DiscountCalculator;
use Travel\Product;

class BreadFreeEveryTwoButterOffer extends DiscountCalculator {

    use ProductCounter;

    public function calculateDiscount(BasketInterface $basket) :float
    {
        $products = $basket->getProducts();
        $evaluation = self::evaluate($products);

        $products = $evaluation['list'];
        $counter = $evaluation['counter'];

        if (array_key_exists('bread', $counter) &&
            array_key_exists('butter', $counter) &&
            $counter['bread'] >= 1 && $counter['butter'] >= 2
        ) {
            /** @var Product $bread */
            $bread  = $products['bread'];
            $couple = $counter['butter']/2;
            $amount = $counter['bread'] > $couple ? $couple : $counter['bread'];

            return $bread->getPrice() * $amount * 0.5;
        }

        return 0.0;
    }
}