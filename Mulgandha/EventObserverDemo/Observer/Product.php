<?php

namespace Mulgandha\EventObserverDemo\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class Product implements ObserverInterface{
    public function execute(Observer $observer)
    {
        // TODO: Implement execute() method.
        $collection = $observer->getEvent()->getData('collection');
        foreach ($collection as $product){
            $price = $product->getData('price');
            $name = $product->getData('name');
            if($price < 60){
                $name .= " So Cheap";
            }else{
                $name .= " So Expensive";
            }
            $product->setData('name',$name);
        }
    }
}
