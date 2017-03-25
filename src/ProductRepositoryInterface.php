<?php

namespace Travel;

interface ProductRepositoryInterface {
    /**
     * @param string $name
     * @return null|\Travel\Product
     */
    public function findByName(string $name) : ?Product;
}