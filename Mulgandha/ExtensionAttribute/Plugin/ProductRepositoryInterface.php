<?php

namespace Mulgandha\ExtensionAttribute\Plugin;

use Magento\Catalog\Api\ProductRepositoryInterface as MagentoRepository;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class ProductRepositoryInterface{

private $collectionFactory;
/**
 * @param CollectionFactory $collectionFactory
 */
    public function __construct(
        CollectionFactory $collectionFactory
    ){
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param MagentoRepository $subject
     * @param ProductInterface $product
     * @return ProductInterface
     */  
    public function afterGet(MagentoRepository $subject,ProductInterface $product){
//        if($product->getExtensionAttributes() && $product->getExtensionAttributes()){
//            return $product;
//        }
        echo $product->getId();

        $isFeatured = $this->getIsFeatured($product->getId());
        if($isFeatured == NULL){
            $isFeatured = "";
            $extensionAttribute = $product->getExtensionAttributes()->setIsFeatured($isFeatured);
        }else{
            $extensionAttribute = $product->getExtensionAttributes()->setIsFeatured($isFeatured);
        }

        $product->setExtensionAttributes($extensionAttribute);
        return $product;
    }

    /**
     * @param $productId
     * @return array|mixed|null
     */
    public function getIsFeatured($productId){
        return $this->collectionFactory->create()->addFieldToFilter('entity_id',['eq'=>$productId])
            ->getFirstItem()->getData('is_featured');
    }
}
