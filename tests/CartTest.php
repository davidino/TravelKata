<?php

namespace Travel\Tests;

use PHPUnit\Framework\TestCase;
use Travel\Product;
use Travel\Cart;
use Travel\ProductRepository;

class CartTest extends TestCase
{
    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function should_throw_expection_when_wrong_product()
    {
        new Cart(new ProductRepository(), [new \stdClass()]);
    }

    /**
     * @test
     */
    public function should_return_the_right_amount_of_total()
    {
        $products = [
            Product::named('milk'),
            Product::named('bread'),
            Product::named('butter'),
        ];

        $expectedTotal = 2.95;

        $cart = new Cart(new ProductRepository(), $products);

        $this->assertTrue($cart->calculateTotal() == $expectedTotal);
    }
}