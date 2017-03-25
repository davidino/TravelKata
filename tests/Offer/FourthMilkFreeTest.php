<?php

namespace Travel\Tests\Offer;

use PHPUnit\Framework\TestCase;
use Travel\Offer\FourthMilkFree;
use Travel\Product;

class FourthMilkFreeTest extends TestCase {

    /**
     * @test
     *
     */
    public function ItShouldApplyTheDiscountWhenFourMilkAreInTheCart()
    {
        $products = [];
        $i=1;
        do {
            $products[] = Product::namedAndPriced('milk', 1.15);
            $i++;
        } while ($i <= 4);

        $offer = new FourthMilkFree($products);

        $this->assertEquals($offer->calculateDiscount(), 1.15);
    }

    /**
     * @test
     *
     */
    public function ItShouldApplyTheDiscountWhenMultipleOfFourMilkAreInTheCart()
    {
        $products = [];
        $i=1;
        do {
            $products[] = Product::namedAndPriced('milk', 1.15);
            $i++;
        } while ($i <= 8);

        $offer = new FourthMilkFree($products);

        $this->assertEquals($offer->calculateDiscount(), 2.3);
    }

    /**
     * @test
     *
     */
    public function ItShouldApplyTheDiscountNotMoreThenTwiceWhenTenMilkInTheCart()
    {
        $products = [];
        $i=1;
        do {
            $products[] = Product::namedAndPriced('milk', 1.15);
            $i++;
        } while ($i <= 10);

        $offer = new FourthMilkFree($products);

        $this->assertEquals($offer->calculateDiscount(), 2.3);
    }

}