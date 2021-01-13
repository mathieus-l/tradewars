<?php

namespace App\Service;

use \App\Service\Logic;
use \App\Service\Entities;
use \App\Service\Interfaces;

class Round
{

    private $market;
    private $pocket;


    public function __construct()
    {
        $this->market = new Logic\CMarket();
    }
    
    public function firstRound(array $products, int $start_pocket_value)
    {
        $this->market->refreshThisMarket();

        foreach ($products AS $product) {
            $this->market->registerProduct($product);
        }
        $this->market->newTurn();
        $this->pocket = new Logic\CPocket();
        $this->pocket->createItemsOfMarket($this->market);
        $this->pocket->setValue($start_pocket_value);

        $this->pocket->refreshThisPocket();

        
    }
    public function newTurn() : void
    {
        $this->market->newTurn();
    }
    public function buy(string $product_name, int $quantity) : void
    {
        $this->pocket->buy($product_name,$quantity);
    }
    public function sell(string $product_name, int $quantity) : void
    {
        $this->pocket->sell($product_name,$quantity);
    }
    public function getItems() 
    {
        return $this->pocket->getItems();

    }
    public function getValue()
    {
        return $this->pocket->getValue();
    }

}