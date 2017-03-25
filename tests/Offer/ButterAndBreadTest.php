<?php

namespace Travel\Tests\Offer;

use PHPUnit\Framework\TestCase;
use Travel\Offer\ButterAndBread;
use Travel\Product;

class ButterAndBreadTest extends TestCase {

    /**
     * @test
     */
    public function test_the_discount_is_applied()
    {
        $products = [
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.8),
            Product::namedAndPriced('butter', 0.8),
        ];

        $offer = new ButterAndBread($products);

        $this->assertEquals($offer->calculateDiscount(), 0.5);
    }

    /**
     * @test
     */
    public function test_the_discount_is_applied_only_once()
    {
        $products = [
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.80),
            Product::namedAndPriced('butter', 0.80),
        ];

        $offer = new ButterAndBread($products);

        $this->assertEquals($offer->calculateDiscount(), 0.5);
    }

    /**
     * @test
     */
    public function test_the_discount_is_applied_twice()
    {
        $products = [
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.80),
            Product::namedAndPriced('butter', 0.80),
            Product::namedAndPriced('butter', 0.80),
            Product::namedAndPriced('butter', 0.80),
        ];

        $offer = new ButterAndBread($products);

        $this->assertEquals($offer->calculateDiscount(), 1.0);
    }

}