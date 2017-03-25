<?php

namespace Travel\Offer;

use Travel\OfferInterface;
use Travel\Product;

class ButterAndBread implements OfferInterface {

    use ProductCounter;

    private $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function calculateDiscount() :float
    {
        $evaluation = self::evaluate($this->products);

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