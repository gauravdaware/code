<?php
namespace Mulgandha\ApiDemo\Api;

use Magento\Framework\Excepetion\NoSuchEntityException;

/**
 * Get Product by its ID
 */
interface ProductRepositoryInterface{
    /**
     * @param int $id
     * @return \Mulgandha\ApiDemo\Api\Data\ProductInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getProductById($id);
}

