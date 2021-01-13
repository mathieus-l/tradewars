<?php
namespace App\Service\Interface;

interface PocketInterface {
    
    public function buy(string $product_name, int $quantity): void;
    public function sell(string $product_name, int $quantity): void;
    public function getItems();
}
