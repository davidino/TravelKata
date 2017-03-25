<?php

namespace Trave\Test;

use PHPUnit\Framework\TestCase;
use Travel\Basket;
use Travel\Calculator;
use Travel\Offer\ButterAndBread;
use Travel\Offer\FourthMilkFree;
use Travel\Product;

class CalculatorTest extends  TestCase {

    /**
     * @test
     */
    public function ItShouldBe(){

        $productSelection = [
            Product::namedAndPriced('milk', 1.15),
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.80),
        ];
        $basket = new Basket($productSelection);

        $offers = [
            ButterAndBread::class,
            FourthMilkFree::class
        ];

        $calculator = Calculator::calculate($basket, $offers);
        $this->assertEquals($calculator->getTotal(), 2.95);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function ItShouldThrowAnExceptionWhenWrongOffersArePassed()
    {
        $basket  = new Basket([Product::namedAndPriced('butter', 0.80)]);
        Calculator::calculate($basket, [\stdClass::class]);
    }
}