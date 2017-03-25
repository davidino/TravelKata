<?php

namespace Travel\Contract;

use Travel\Product;

interface ProductRepositoryInterface {
    public function findByName(string $name) : ?Product;
}