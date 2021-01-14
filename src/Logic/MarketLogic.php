<?php

namespace App\Logic;

use App\Interfaces\MarketInterface;

class MarketLogic implements MarketInterface
{
    private $_products = [];
    private $turn =0;
    public function __construct($products) {
        $this->_products = $products;
    } 

    public function findProduct(string $name): ?object
    {
        foreach ($this->_products as $product)
        {
            if ($product->getName() == $name)
            {
                return $product;
            }
        }
        return null;
    }
    public function newTurn(): void {
        $this->turn++;
        foreach ($this->_products as $product) {
            $this->_new_products[] = $product->loteryPrice();
        }
        $this->_products = $this->_new_products;
    }
    public function getProducts() {
        return $this->_products;
    }


}
