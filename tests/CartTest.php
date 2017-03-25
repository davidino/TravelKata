<?php

namespace Travel\Tests;

use PHPUnit\Framework\TestCase;
use Travel\Cart;
use Travel\Offer\FourthMilkFree;
use Travel\Offer\ButterAndBread;
use Travel\InMemoryProductRepository;

class CartTest extends TestCase
{

    /**
     * @test
     */
    public function should_return_the_right_amount_of_total()
    {
        $products = ['milk',  'bread', 'butter'];
        $offers = [
            ButterAndBread::class,
            FourthMilkFree::class
        ];

        $expectedTotal = 2.95;

        $cart = new Cart(new InMemoryProductRepository(), $offers, $products);

        $this->assertTrue($cart->calculateTotal() == $expectedTotal);
    }
}