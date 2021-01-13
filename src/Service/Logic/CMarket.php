<?php

namespace App\Service\Logic;

class CMarket implements \App\Service\Interfaces\IMarket
{
    private $_products = [];
    private $turn =0;
    public function __construct() {
        $this->loadThisMarket();
    } 

    public function loadThisMarket() {
        
        if (isset($_SESSION['isProduct']))
        {
            $this->_products = unserialize($_SESSION['_products']);
            $this->turn = $_SESSION['turn'];
        }
        
    }
    private function saveThisMarket() {
        $_SESSION['_products'] = serialize($this->_products);
        $_SESSION['turn'] = $this->turn;
        $_SESSION['isProduct'] = 'yes';
    }
    public function refreshThisMarket() {
        if (isset($_SESSION))
        {
            unset($_SESSION['_products']);
            unset($_SESSION['turn']);
            unset($_SESSION['isProduct']);
        }
    }

    public function registerProduct(object $product):void 
    {
        $this->_products[] = $product;
        $this->saveThisMarket();
        
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
        $this->saveThisMarket();
    }
    public function getProducts() {
        return $this->_products;
    }


}
