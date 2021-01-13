<?php declare(strict_types=1);

use App\Service\Round;
use App\Service\Entities;
use App\Service\Logic;

class indexTest extends PHPUnit\Framework\TestCase {
    /**
     * @test
     */
    public function isBuyingOk(): void
    {
           $round = new Round();
           $product_1 = new Entities\Product();
           $product_1->setName('koka');
           $product_1->setAveragePrice(20000);
           $product_1->setVariation(10000);


           $product_2 = new Entities\Product();
           $product_2->setName('hera');
           $product_2->setAveragePrice(10000);
           $product_2->setVariation(5000);


           $product_3 = new Entities\Product();
           $product_3->setName('hasz');
           $product_3->setAveragePrice(100);
           $product_3->setVariation(50);


           $product_4 = new Entities\Product();
           $product_4->setName('lsd');
           $product_4->setAveragePrice(500);
           $product_4->setVariation(0);


           $round = new Round;
           
           $round->firstRound([$product_1, $product_2, $product_3, $product_4], 5000);

           $round->buy('lsd', 10);

           foreach ($round->getItems() as $item) {
               if ($item->getName() == 'lsd')
               {
                    $this->assertEquals(10, $item->getQuantity());
                    
               }
           }
           $this->assertEquals(0, $round->getValue());
    }
    /**
     * @test
     */
    public function isSellingOk() :void {
           $round = new Round();
           $round->newTurn();
           $this->assertEquals(0, $round->getValue());
           foreach ($round->getItems() AS $item) {
               if ($item->getName() == 'lsd')
               {
                    $this->assertEquals(10, $item->getQuantity());
                    
               }
           }
           
           $round->sell('lsd', 10);
           $this->assertEquals(5000, $round->getValue());
           foreach ($round->getItems() AS $item) {
               if ($item->getName() == 'lsd')
               {
                    $this->assertEquals(0, $item->getQuantity());
                    
               }
           }  
    }
    
    
}
