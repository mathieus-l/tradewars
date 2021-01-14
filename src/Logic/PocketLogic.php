<?php

namespace App\Logic;

use App\Interfaces\PocketInterface;



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
                        $item->persist();
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

    public function getValue() {
        return $this->value;
    }
        
    public function getItems() 
    {

        return $this->_items;
    }
    
}
