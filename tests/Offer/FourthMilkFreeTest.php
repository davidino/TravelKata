<?php

namespace Travel\Tests\Offer;

use PHPUnit\Framework\TestCase;
use Travel\Basket;
use Travel\DiscountCalculator;
use Travel\Offer\FourthMilkFreeOffer;
use Travel\Product;

class FourthMilkFreeTest extends TestCase {
    /** @var FourthMilkFreeOffer  */
    private $offer;

    public function setup() {
        $this->offer = new FourthMilkFreeOffer();
    }

    /**
     * @test
     *
     */
    public function ItShouldApplyTheDiscountWhenFourMilkAreInTheCart()
    {
        $products = [];
        $i=1;
        do {
            $products[] = Product::namedAndPriced('milk', 1.15);
            $i++;
        } while ($i <= 4);

        $basket = $this->prophesize(Basket::class);
        $basket->getProducts()->willReturn($products);
        $discount = $this->offer->calculateDiscount($basket->reveal());

        $this->assertEquals($discount, 1.15);
    }

    /**
     * @test
     *
     */
    public function ItShouldApplyTheDiscountWhenMultipleOfFourMilkAreInTheCart()
    {
        $products = [];
        $i=1;
        do {
            $products[] = Product::namedAndPriced('milk', 1.15);
            $i++;
        } while ($i <= 8);

        $basket = $this->prophesize(Basket::class);
        $basket->getProducts()->willReturn($products);

        $discount = $this->offer->calculateDiscount($basket->reveal());

        $this->assertEquals($discount , 2.3);
    }

    /**
     * @test
     *
     */
    public function ItShouldApplyTheDiscountNotMoreThenTwiceWhenTenMilkInTheCart()
    {
        $products = [];
        $i=1;
        do {
            $products[] = Product::namedAndPriced('milk', 1.15);
            $i++;
        } while ($i <= 10);

        $basket = $this->prophesize(Basket::class);
        $basket->getProducts()->willReturn($products);
        $discount = $this->offer->calculateDiscount($basket->reveal());

        $this->assertEquals($discount, 2.3);
    }

}