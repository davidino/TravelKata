<?php

namespace Travel\Tests\Examples;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Travel\Basket;
use Travel\Calculator;
use Travel\Offer\BreadFreeEveryTwoButterOffer;
use Travel\Offer\FourthMilkFreeOffer;
use Travel\Infrastructure\InMemoryProductRepository;
use Travel\Product;

/**
 * Defines application features from the specific context.
 */
class BasketContext implements Context
{
    private $basket;
    /** @var  Calculator */
    private $calculator;

    private $repository;

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

        $this->repository = new InMemoryProductRepository($productsCatalog);

        $this->basket = Basket::initializeEmtpy();
    }

    /**
     * @Given the basket has:
     */
    public function theBasketHas(TableNode $table)
    {
        foreach ($table as $row) {
            if($prod = $this->repository->findByName($row['name'])) {
                $this->basket->add($prod, $row['qty']);
            }
        }
    }

    /**
     * @When I total the basket
     */
    public function iTotalTheBasket()
    {
        $offers = [
            BreadFreeEveryTwoButterOffer::class,
            FourthMilkFreeOffer::class
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
