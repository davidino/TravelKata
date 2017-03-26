<?php

namespace Travel;

interface OfferInterface {
    /**
     * @param array $product
     * @return float
     */
    public static function calculateDiscount(array $product):float ;
}