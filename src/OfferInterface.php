<?php

namespace Travel;

interface OfferInterface {
    /**
     * @return float
     */
    public function calculateDiscount():float ;
}