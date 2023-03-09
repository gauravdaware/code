<?php
namespace Mulgandha\ApiDemo\Model;

use Mulgandha\ApiDemo\Api\ProductRepositoryInterface;
use \Mulgandha\ApiDemo\Api\Data\ProductInterfaceFactory;
use \Magento\Framework\Exception\NoSuchEntityException;
use Mulgandha\ApiDemo\Helper\Data;
class ProductRepository implements ProductRepositoryInterface{
    /**
     * @var ProductInterfaceFactory
     */
    private $productInterfaceFactory;
    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;

    private $data;

    /**
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param ProductInterfaceFactory $productInterfaceFactory
     */
    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        ProductInterfaceFactory $productInterfaceFactory,
        Data $data
    )
    {
        $this->productRepository = $productRepository;
        $this->productInterfaceFactory = $productInterfaceFactory;
    }

    public function getProductById($id)
    {
        $productInterface = $this->productInterfaceFactory->create();
        try{
            $product = $this->productRepository->getById($id);
            $productInterface->setId($product->getId());
            $productInterface->setSku($product->getSku());
            $productInterface->setName($product->getname());
            $productInterface->setDescription($product->getDescription());
            $productInterface->setPrice($product->getPrice());
            $productInterface->setImages($product->getImages());
            return $productInterface;
        }
        catch(NoSuchEntityException $e){
            throw NoSuchEntityException::singleField('id',$id);
        }
    }
}
