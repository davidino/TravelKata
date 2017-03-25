<?php

namespace Travel\Tests;

use PHPUnit\Framework\TestCase;
use Travel\Product;

class ProductTest extends TestCase
{
    /**
     * @test ItShouldCreateANewProductFromNameAndAmount
     */
    public function ItShouldCreateANewProductFromNameAndAmount()
    {
        $product = Product::namedAndPriced('named', 12.1);
        $this->assertInstanceOf('Travel\Product', $product);
    }
}