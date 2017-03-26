<?php

namespace Travel\Tests;

use PHPUnit\Framework\TestCase;
use Travel\Basket;
use Travel\Product;

class BasketTest extends TestCase
{
    /**
     * @test
     */
    public function ItShouldInitializeAnEmptyBasket()
    {
        $basket = Basket::initializeEmtpy();

        $this->assertCount(0, $basket->getProducts());
    }

    /**
     * @test
     */
    public function ItShouldInitializeABasketWithProducts()
    {
        $basket = Basket::initializeWithProducts([
            Product::namedAndPriced('bread',1.0),
            Product::namedAndPriced('milk',1.5),
        ]);

        $this->assertCount(2, $basket->getProducts());
    }

    /**
     * @test
     */
    public function ItShouldAddItemsToTheCart() {
        $basket = Basket::initializeWithProducts([Product::namedAndPriced('milk',1.0)]);
        $basket->add(Product::namedAndPriced('bread',1.0), 2);

        $this->assertCount(3, $basket->getProducts());
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function ItShouldThrowAnExceptionWhenTheProductDoesNotExists()
    {
        Basket::initializeWithProducts(['oreo']);
    }
}