<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationPositions\Plugins;

use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Layout;
use Manadev\LayeredNavigationPositions\Configuration;
use Manadev\LayeredNavigationPositions\Sources\AboveProductsPosition;

class AbstractBlockPlugin
{
    /**
     * @var Layout
     */
    protected $layout;
    /**
     * @var Configuration
     */
    protected $configuration;

    public function __construct(Layout $layout, Configuration $configuration) {
        $this->layout = $layout;
        $this->configuration = $configuration;
    }

    public function afterToHtml(AbstractBlock $subject, $result) {
        if ($position = $subject->getData('manadev_product_list')) {
            if ($this->configuration->getAboveProductsPosition() == AboveProductsPosition::ABOVE_PRODUCTS) {
                if ($position == 'before') {
                    return $this->layout->getBlock('above_products.mana.layered_nav')->toHtml() . $result;
                }

                if ($position == 'after') {
                    return $result . $this->layout->getBlock('above_products.mana.layered_nav')->toHtml();
                }
            }
        }

        if ($position = $subject->getData('manadev_description')) {
            if ($this->configuration->getAboveProductsPosition() == AboveProductsPosition::BELOW_DESCRIPTION) {
                if ($position == 'before') {
                    return $this->layout->getBlock('above_products.mana.layered_nav')->toHtml() . $result;
                }

                if ($position == 'after') {
                    return $result . $this->layout->getBlock('above_products.mana.layered_nav')->toHtml();
                }
            }
        }

        return $result;
    }
}