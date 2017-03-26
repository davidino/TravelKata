<?php

namespace Trave\Test;

use PHPUnit\Framework\TestCase;
use Travel\Basket;
use Travel\Calculator;
use Travel\Offer\BreadFreeEveryTwoButterOffer;
use Travel\Offer\FourthMilkFreeOffer;
use Travel\Product;

class CalculatorTest extends  TestCase {

    /**
     * @test
     */
    public function ItShouldCalculateTheRightTotalWithoutTheOffers() {

        $basket = $this->prophesize(Basket::class);
        $basket->getProducts()->willReturn([
            Product::namedAndPriced('milk', 1.15),
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.80),
        ]);

        $calculator = Calculator::calculate($basket->reveal());
        $this->assertEquals($calculator->getTotal(), 2.95);
    }


    /**
     * @test
     */
    public function ItShouldCalculateTheRightTotal() {

        $basket = $this->prophesize(Basket::class);
        $basket->getProducts()->willReturn([
                Product::namedAndPriced('milk', 1.15),
                Product::namedAndPriced('bread', 1.0),
                Product::namedAndPriced('butter', 0.80),
        ]);

        $discountCalculator =    new BreadFreeEveryTwoButterOffer();
        $discountCalculator->setSuccessor(new FourthMilkFreeOffer());

        $calculator = Calculator::calculate($basket->reveal(), $discountCalculator);
        $this->assertEquals($calculator->getTotal(), 2.95);
    }

    /**
     * @test
     */
    public function ItShouldCalculateTheRightTotalWhenOffersAreEnabled() {

        $basket = $this->prophesize(Basket::class);
        $basket->getProducts()->willReturn([
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.80),
            Product::namedAndPriced('butter', 0.80),
        ]);

        $discountCalculator =    new BreadFreeEveryTwoButterOffer();
        $discountCalculator->setSuccessor(new FourthMilkFreeOffer());

        $calculator = Calculator::calculate($basket->reveal(), $discountCalculator);
        $this->assertEquals($calculator->getTotal(), 3.10);
    }

}