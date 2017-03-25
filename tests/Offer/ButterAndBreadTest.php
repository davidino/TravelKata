<?php

namespace Travel\Tests\Offer;

use PHPUnit\Framework\TestCase;
use Travel\Offer\BreadFreeEveryTwoButterOffer;
use Travel\Product;

class ButterAndBreadTest extends TestCase {

    /**
     * @test
     */
    public function ItShouldApplyTheDiscountWhenTwoButterAndOneBreadInTheCart()
    {
        $products = [
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.8),
            Product::namedAndPriced('butter', 0.8),
        ];

        $offer = new BreadFreeEveryTwoButterOffer($products);

        $this->assertEquals($offer->calculateDiscount(), 0.5);
    }

    /**
     * @test
     */
    public function ItShouldApplyTheDiscountWhenTwoButterAndTwoBreadInTheCart()
    {
        $products = [
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.80),
            Product::namedAndPriced('butter', 0.80),
        ];

        $offer = new BreadFreeEveryTwoButterOffer($products);

        $this->assertEquals($offer->calculateDiscount(), 0.5);
    }

    /**
     * @test
     */
    public function ItShouldApplyTheDiscountTwiceWhenFourButterAndThreeBreadInTheCart()
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

        $offer = new BreadFreeEveryTwoButterOffer($products);

        $this->assertEquals($offer->calculateDiscount(), 1.0);
    }

}