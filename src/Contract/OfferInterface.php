<?php

namespace Travel\Contract;

interface OfferInterface {

    public function __construct(array $products);

    /**
     * @return float
     */
    public function calculateDiscount():float ;
}