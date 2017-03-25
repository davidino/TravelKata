<?php

namespace Travel;

use Travel\Product;

interface ProductRepositoryInterface {
    public function findByName(string $name) : ?Product;
}