<?php

namespace Travel\Offer;

use Travel\Contract\OfferInterface;
use Travel\Product;

class FourthMilkFree implements OfferInterface {

    private $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    // Buy 3 Milk and get the 4th milk for free

    public function calculateDiscount() :float
    {
        $products = [];
        $counter = [
            'milk' => 0,
        ];

        /** @var Product $product */
        foreach ($this->products as  $product) {
            $productName = $product->getName();
            if (array_key_exists($productName, $counter)) {
                $counter[$productName]++;
                $products[$product->getName()] = $product;
            }
        }

        if ($counter['milk'] >= 4) {
            /** @var Product $milk */
            $milk = $products['milk'];
            $res = floor($counter['milk']/4);

            return $res * $milk->getPrice();
        }

        return 0.0;
    }
}