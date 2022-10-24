<?php declare(strict_types=1);

namespace Algortima\Mobilifiver\ViewModel;

use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Helper\Image;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\ResourceModel\Product;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Element\Template;

class ImageProperties extends Template implements ArgumentInterface
{
    protected ProductRepository $_productRepository;
    protected Image $_productImageHelper;

    public function __construct(
        Context $context,
        ProductRepository $productRepository,
        Image $productImageHelper,
        array $data = []
    )
    {
        $this->_productRepository = $productRepository;
        $this->_productImageHelper= $productImageHelper;
        parent::__construct($context, $data);
    }


    /**
     * @param $id
     * @return ProductInterface|mixed|null
     * @throws NoSuchEntityException
     */
    public function getProductById($id)
    {
        return $this->_productRepository->getById($id);
    }

    /**
     * @param $product
     * @param $imageId
     * @param $attributes
     * @return mixed
     */
    public function getImageOriginalWidth($product, $imageId, $attributes = [])
    {
        return $this->_productImageHelper->init($product, $imageId, $attributes)->getWidth();
    }

    /**
     * @param $product
     * @param $imageId
     * @param $attributes
     * @return mixed
     */
    public function getImageOriginalHeight($product, $imageId, $attributes = [])
    {
        return $this->_productImageHelper->init($product, $imageId, $attributes)->getHeight();
    }
}





//
//    {
//        $this->_productRepository = $productRepository;
//        $this->_productImageHelper = $productImageHelper;
//        parent::__construct($context, $data);
//    }
//
//
//
//    public function getProductBySku($sku)
//    {
//        return $this->_productRepository->get($sku);
//    }
//
//    /**
//     * Retrieve image width
//     *
//     * @return int|null
//     */
//    public function getImageOriginalWidth($product, $imageId, $attributes = [])
//    {
//        return $this->_productImageHelper->init($product, $imageId, $attributes)->getWidth();
//    }
//
//    /**
//     * Retrieve image height
//     *
//     * @return int|null
//     */
//    public function getImageOriginalHeight($product, $imageId, $attributes = [])
//    {
//        return $this->_productImageHelper->init($product, $imageId, $attributes)->getHeight();
//    }
//}
