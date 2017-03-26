<?php

namespace Travel;

abstract class DiscountCalculator {
    /**
     * @var DiscountCalculator | null
     */
    private $successor = null;

    public function __construct(DiscountCalculator $handler = null)
    {
        $this->successor = $handler;
    }

    final public function setSuccessor(DiscountCalculator $handler)
    {
        if ($this->successor === null) {
            $this->successor = $handler;
        } else {
            $this->successor->setSuccessor($handler);
        }
    }

    final public function handle(BasketInterface $basket) :float
    {
        $discount = $this->calculateDiscount($basket);

        if ($this->successor !== null) {
            $discount += $this->successor->handle($basket);
        }

        return $discount;
    }

    abstract protected function calculateDiscount(BasketInterface $basket);
}