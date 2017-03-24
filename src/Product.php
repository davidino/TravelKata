<?php
namespace Travel;

class Product
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function named($name)
    {
        return new self($name);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}