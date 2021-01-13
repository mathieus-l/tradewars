<?php
namespace App\Service\Entities;


class Item {
    private $name;
    private $quantity;
    private $buy_price;

    public function __construct(string $name) {
        $this->name = $name;
        $this->quantity = 0;
        $this->buy_price = 0;
    } 

    public function setName(string $name):void {
        $this->name = $name; 
        
    }
    public function getName(): string {
        return $this->name;
    }

    public function setQuantity(int $quantity):void {
        $this->quantity = $quantity;
    }
    public function getQuantity():int {
        return $this->quantity;
    }
    public function getBuyPrice() {
        return $this->buy_price;
    }

    public function setBuyPrice($buy_price) {
        $this->buy_price = $buy_price;
    }


}
