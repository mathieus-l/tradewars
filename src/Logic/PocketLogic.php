<?php

namespace App\Logic;

use App\Entities\Item;
use App\Interface;

class PocketLogic implements PocketInterface 
{

    private $_items = null;
    private $market;
    private $value;
    public function __construct() 
    {
        $this->loadThisPocket();
    } 
    public function createItemsOfMarket(object $Market) {
        $this->market = $Market;
        foreach ($this->market->getProducts() As $product)
        {
            $this->_items[] = new Item($product->getName());
        }
        $this->saveThisPocket();
        
    }
    public function setValue($value)
    {
        $this->value = $value;
    }
    public function buy(string $name, $quantity): void 
    {
        $product = $this->market->findProduct($name);
        if (!empty($product))
        {
            if ($this->value >= $product->getCurrentPrice() * $quantity) {
                $this->value = $this->value - $product->getCurrentPrice() * $quantity;
                foreach ($this->_items as $item) {
                    if ($item->getName() == $name) {
                        $item->setQuantity($item->getQuantity() + $quantity);
                        $item->setBuyPrice($product->getCurrentPrice());
                    }                
                }
                $this->saveThisPocket();
            }
        }
    }
    public function sell(string $name, int $quantity): void {
        $product = $this->market->findProduct($name);
        if (!empty($product))
        {
                $this->value = $this->value + $product->getCurrentPrice() * $quantity;
                foreach ($this->_items as $item) {
                    if ($item->getName() == $name ) {
                        if ($item->getQuantity() <= $quantity) {
                            $item->setQuantity($item->getQuantity() - $quantity);
                            $item->setBuyPrice(0);
                        }
                }
                $this->saveThisPocket();
            }
        }
    }
    private function saveThisPocket()
    {
        $_SESSION['_items'] = serialize($this->_items); 
        $_SESSIN['market'] = serialize($this->market);
        $_SESSION['value'] = $this->value;
        $_SESSION['isPocket'] = 'true';
        
    }
    private function loadThisPocket() {
        if (isset($_SESSION['isPocket'])) {
            $this->_items = unserialize($_SESSION['_items']);
            $this->market = unserialize($_SESSION['market']);
            $this->value = $_SESSION['value'];
        }
    }

    public function refreshThisPocket() {
        if (isset($_SESSION)) {
            unset($_SESSION['_items']); 
            unset($_SESSION['market']);
            unset($_SESSION['value']);
            unset($_SESSION['isPocket']);
        }
    }

    public function getValue() {
        return $this->value;
    }
        
    public function getItems() 
    {

        return $this->_items;
    }
    
}
