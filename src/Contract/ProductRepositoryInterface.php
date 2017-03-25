<?php

namespace Travel\Contract;

use Travel\Product;

interface ProductRepositoryInterface {
    public function findByName($name) : ?Product;
}