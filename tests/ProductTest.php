<?php

namespace Travel\Order\Tests;

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
        $product = Product::named('named');
        $this->assertInstanceOf('Travel\Product', $product);
    }
}