<?php

namespace Travel\Offer;

use Travel\Product;

trait ProductCounter {

    public function evaluate($products) {

        $counter = [];
        $list = [];

        /** @var Product $product */
        foreach ($products as  $product) {
            $productName = $product->getName();

            $counter[$productName] = array_key_exists($productName, $counter) ? $counter[$productName] + 1 : 1;
            $list[$productName] = $product;
        }

        return [
            'counter' => $counter,
            'list'    => $list
        ];
    }
}