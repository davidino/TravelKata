<?php

namespace Travel\Tests\Examples;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Money\Money;
use Travel\Cart;
use Travel\Offer\ButterAndBread;
use Travel\Offer\FourthMilkFree;
use Travel\InMemoryProductRepository;
use Travel\Product;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $cart;

    /**
     * Initializes context.
    */
    public function __construct()
    {
        $productsCatalog = [
            Product::namedAndPriced('milk', 1.15),
            Product::namedAndPriced('bread', 1.0),
            Product::namedAndPriced('butter', 0.80),
        ];

        $offers = [
            ButterAndBread::class,
            FourthMilkFree::class
        ];

        $this->cart = new Cart(new InMemoryProductRepository($productsCatalog), $offers);
    }

    /**
     * @Given the basket has:
     */
    public function theBasketHas(TableNode $table)
    {
        foreach ($table as $row) {
            $this->cart->add($row['name'],$row['qty']);
        }
    }

    /**
     * @When I total the basket
     */
    public function iTotalTheBasket()
    {
        $this->cart->calculateTotal();
    }

    /**
     * @Then the total should be £:expectedTotal
     */
    public function theTotalShouldBePs($expectedTotal)
    {
        if (abs($this->cart->getTotal() - floatval($expectedTotal)) > 0.1){
        //if ($this->cart->getTotal() !== floatval($expectedTotal)) {
            throw new \Exception("Total amount is " . $this->cart->getTotal(). " instead of $expectedTotal");
        }
    }
}
