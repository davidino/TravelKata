<?php

namespace Travel\Tests;

use PHPUnit\Framework\TestCase;
use Travel\Cart;
use Travel\Offer\FourthMilkFree;
use Travel\Offer\ButterAndBread;
use Travel\Infrastructure\InMemoryProductRepository;
use Travel\Product;

class CartTest extends TestCase
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
        $cart = new Cart(new InMemoryProductRepository($this->catalog), [], ['oreo']);
    }

    /**
     * @test
     */
    public function ItShouldAddItemsToTheCart(){
        $cart = new Cart(new InMemoryProductRepository($this->catalog), [], ['milk']);

        $cart->add('bread',2);

        $this->assertCount(3, $cart->getProducts());
    }

    /**
     * @test
     */
    public function ItShouldCalculateTheCorrectAmount()
    {
        $productSelection = ['milk',  'bread', 'butter'];

        $offers = [
            ButterAndBread::class,
            FourthMilkFree::class
        ];

        $expectedTotal = 2.95;

        $cart = new Cart(new InMemoryProductRepository($this->catalog), $offers, $productSelection);

        $this->assertTrue($cart->calculateTotal() == $expectedTotal);
    }
}