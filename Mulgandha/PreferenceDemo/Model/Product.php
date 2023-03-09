<?php

namespace Mulgandha\PreferenceDemo\Model;

class Product extends \Magento\Catalog\Model\Product{
    public $_product;

    public function __construct(\Magento\Catalog\Model\Product $product)
    {
        $this->_product = $product;
    }
    public function getName(){
       $name = parent::getName();
       $price = $this->getData('price');
       if($price < 60){
           $name .= " So Cheap";
       }else{
           $name .= " So Expensive";
       }
       return $name;
   }
}
