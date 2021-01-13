<?php

namespace App\Service\Entities;


class Product {

    private $name;
    private $average_price;
    private $variation;
    private $current_price;


    public function setName(string $name):void {
        $this->name = $name; 
        
    }
    
    public function setAveragePrice(int $average_price):void {
        $this->average_price = $average_price;
    }
    public function setVariation(int $variation):void {
        $this->variation = $variation;
    }
    public function getName() {
        return $this->name;
    }

    public function getAveragePrice() {
        return $this->average_price;
    }

    public function getVariation() {
        return $this->variation;
    }
    
    public function getCurrentPrice() {
        return $this->current_price;
    }
    

    public function setCurrentPrice($current_price) {
        $this->current_price = $current_price;
        return $this;
    }

        
    
    public function loteryPrice() {
        $this->current_price = $this->average_price + random_int(-$this->variation, $this->variation);
        return $this;
    }
}
