<?php

namespace Travel\Tests\Offer;

use PHPUnit\Framework\TestCase;
use Travel\Basket;
use Travel\Offer\BreadFreeEveryTwoButterOffer;
use Travel\Product;

class ButterAndBreadTest extends TestCase {
    /** @var  BreadFreeEveryTwoButterOffer  */
    private $offer;

    public function setup(){
        $this->offer = new BreadFreeEveryTwoButterOffer();
    }

    /**
     * @test
     */
    public function ItShouldApplyTheDiscountWhenTwoButterAndOneBreadInTheCart()
    {
        $basket = $this->prophesize(Basket::class);
        $basket->getProducts()->willReturn([
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.8),
            Product::namedAndPriced('butter', 0.8),
        ]);

        $discount = $this->offer->calculateDiscount($basket->reveal());

        $this->assertEquals($discount, 0.5);
    }

    /**
     * @test
     */
    public function ItShouldApplyTheDiscountWhenTwoButterAndTwoBreadInTheCart()
    {
        $basket = $this->prophesize(Basket::class);
        $basket->getProducts()->willReturn([
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.80),
            Product::namedAndPriced('butter', 0.80),
        ]);

        $discount = $this->offer->calculateDiscount($basket->reveal());

        $this->assertEquals($discount , 0.5);
    }

    /**
     * @test
     */
    public function ItShouldApplyTheDiscountTwiceWhenFourButterAndThreeBreadInTheCart()
    {
        $basket = $this->prophesize(Basket::class);
        $basket->getProducts()->willReturn([
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.80),
            Product::namedAndPriced('butter', 0.80),
            Product::namedAndPriced('butter', 0.80),
            Product::namedAndPriced('butter', 0.80),
        ]);

        $discount = $this->offer->calculateDiscount($basket->reveal());

        $this->assertEquals($discount, 1.0);
    }

}