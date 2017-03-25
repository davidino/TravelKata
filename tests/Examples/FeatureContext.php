<?php

namespace Travel\Tests\Examples;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Travel\Basket;
use Travel\Calculator;
use Travel\Offer\ButterAndBread;
use Travel\Offer\FourthMilkFree;
use Travel\Infrastructure\InMemoryProductRepository;
use Travel\Product;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $basket;
    /** @var  Calculator */
    private $calculator;

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

        $this->basket = new Basket(new InMemoryProductRepository($productsCatalog),[]);
    }

    /**
     * @Given the basket has:
     */
    public function theBasketHas(TableNode $table)
    {
        foreach ($table as $row) {
            $this->basket->add($row['name'],$row['qty']);
        }
    }

    /**
     * @When I total the basket
     */
    public function iTotalTheBasket()
    {
        $offers = [
            ButterAndBread::class,
            FourthMilkFree::class
        ];

        $this->calculator = Calculator::calculate($this->basket, $offers);
    }

    /**
     * @Then the total should be £:expectedTotal
     */
    public function theTotalShouldBePs($expectedTotal)
    {
        if (abs($this->calculator->getTotal() - floatval($expectedTotal)) > 0.1){
            throw new \Exception("Total amount is " . $this->basket->getTotal(). " instead of $expectedTotal");
        }
    }
}
