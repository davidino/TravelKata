<?php

namespace Travel\Tests;

use PHPUnit\Framework\TestCase;
use Travel\Product;
use Money\Money;

class ProductTest extends TestCase
{
    /**
     * @test
     */
    public function should_create_a_new_product_from_name_and_amount_in_euro()
    {
        $product = Product::namedAndPriced('named', 12.1);
        $this->assertInstanceOf('Travel\Product', $product);
    }
}