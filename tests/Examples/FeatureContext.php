<?php

namespace Travel\Tests\Examples;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Money\Money;
use Travel\Cart;
use Travel\Product;
use Travel\ProductRepository;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $cart;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->cart = new Cart(new ProductRepository());
    }

    /**
     * @Given the basket has:
     */
    public function theBasketHas(TableNode $table)
    {
        foreach ($table as $row) {
            $this->cart->add(
                Product::named($row['name']),
                $row['qty']
            );
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
     * @Then the total should be £:arg1
     */
    public function theTotalShouldBePs($expectedTotal)
    {
        if ($this->cart->getTotal() != $expectedTotal) {
            throw new \Exception("Total amount is not" . $expectedTotal);
        }
    }
}
