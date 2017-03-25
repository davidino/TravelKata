<?php

namespace Trave\Test;

use PHPUnit\Framework\TestCase;
use Travel\Basket;
use Travel\Calculator;
use Travel\Infrastructure\InMemoryProductRepository;
use Travel\Offer\ButterAndBread;
use Travel\Offer\FourthMilkFree;
use Travel\Product;

class CalculatorTest extends  TestCase {

    private $catalog;

    public function setup()
    {
        $this->catalog = [
            Product::namedAndPriced('milk', 1.15),
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.80),
        ];
    }

    /**
     * @test
     */
    public function ItShouldBe(){

        $repo = new InMemoryProductRepository($this->catalog);
        $productSelection = ['milk',  'bread', 'butter'];
        $basket = new Basket($repo, $productSelection);

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
        $basket  = new Basket(new InMemoryProductRepository($this->catalog), ['milk']);
        Calculator::calculate($basket, [\stdClass::class]);
    }
}