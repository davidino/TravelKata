<?php
namespace Travel;

class Product
{
    private $name;
    private $price;


    /**
     * Product constructor.
     * @param string $name
     * @param float $price
     */
    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @param string $name
     * @param float $money
     * @return Product
     */
    public static function namedAndPriced(string $name, float $money) :Product
    {
        return new self($name, $money);
    }

    /**
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice() :float
    {
        return $this->price;
    }
}