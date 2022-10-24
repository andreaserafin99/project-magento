<?php declare(strict_types=1);

namespace Algoritma\Outlet\ViewModel\Outlet;

use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Element\Template\Context;
use Algoritma\Outlet\Helper\Mapper;

class CategoriesOutlet implements ArgumentInterface
{

    /**
     * @var Mapper
     */
    private $mapper;
    /**
     * @var Resolver
     */
    protected $resolver;
    /**
     * @var Context
     */
    private $context;
    private $data;

    public function __construct(
        Mapper   $mapper,
        Resolver $resolver
    ) {
        $this->mapper = $mapper;
        $this->resolver = $resolver;
    }

    /**
     * @param $product ProductInterface
     * @param $category CategoryInterface
     * @return bool
     */
    public function displayBadgeOutlet($product, $category): bool
    {
        $isProductOutlet = $product->getCustomAttribute('is_outlet') != null;
        $isCategoryExluded = false;
        if ($category != null) {
            $currentCategoryId = $category->getId();
            $isCategoryExluded = $this->mapper->isCategoryEnabled($currentCategoryId);
        }
        if ($isProductOutlet && !$isCategoryExluded) {
            return true;
        } else {
            return false;
        }
    }

    public function getCurrentCategory(): Category
    {
        return $this->resolver->get()->getCurrentCategory();
    }
}
