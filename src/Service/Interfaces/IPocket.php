<?php
namespace App\Service\Interfaces;

interface IPocket {
    
    public function buy(string $product_name, int $quantity): void;
    public function sell(string $product_name, int $quantity): void;
    public function getItems();
}
