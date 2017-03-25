<?php

namespace Travel;

interface BasketInterface {
    public function add(Product $productName, int $qty);

    public function getProducts() : array ;
}