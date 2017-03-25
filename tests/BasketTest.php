<?php

namespace Travel\Tests;

use PHPUnit\Framework\TestCase;
use Travel\Basket;
use Travel\Offer\FourthMilkFree;
use Travel\Offer\ButterAndBread;
use Travel\Infrastructure\InMemoryProductRepository;
use Travel\Product;

class BasketTest extends TestCase
{
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
     * @expectedException \InvalidArgumentException
     */
    public function ItShouldThrowAnExceptionWhenTheProductDoesNotExists()
    {
        $basket = new Basket(new InMemoryProductRepository($this->catalog), ['oreo']);
    }

    /**
     * @test
     */
    public function ItShouldAddItemsToTheCart(){
        $basket = new Basket(new InMemoryProductRepository($this->catalog), ['milk']);

        $basket->add('bread',2);

        $this->assertCount(3, $basket->getProducts());
    }
}