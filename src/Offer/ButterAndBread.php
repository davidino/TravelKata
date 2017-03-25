<?php

namespace Travel\Offer;

use Travel\Contract\OfferInterface;
use Travel\Product;

class ButterAndBread implements OfferInterface {

    private $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    // Buy 2 Butter and get a Bread at 50% off

    public function calculateDiscount() :float
    {
        $products = [];
        $counter = [
            'butter' => 0,
            'bread'  => 0,
        ];

        /** @var Product $product */
        foreach ($this->products as  $product) {
            $productName = $product->getName();
            if (array_key_exists($productName, $counter)) {
                $counter[$productName]++;
                $products[$product->getName()] = $product;
            }
        }

        if ($counter['bread'] >= 1 && $counter['butter'] >= 2) {
            /** @var Product $bread */
            $bread  = $products['bread'];
            $couple = $counter['butter']/2;
            $amount = $counter['bread'] > $couple ? $couple : $counter['bread'];

            return $bread->getPrice() * $amount * 0.5;
        }

        return 0.0;
    }
}