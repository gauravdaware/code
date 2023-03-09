<?php
namespace Mulgandha\PluginDemo\Plugins;


class Product{
    public function afterGetName(\Magento\Catalog\Model\Product $product, $name){
        $price = $product->getData('price');
        if ($price < 60){
            $name .= " So Cheap";
        }else{
            $name .= " Expensive";
        }
        return $name;
    }

}
