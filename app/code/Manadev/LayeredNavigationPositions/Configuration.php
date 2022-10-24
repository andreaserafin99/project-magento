<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationPositions;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Configuration
{
    const ABOVE_PRODUCTS_TEMPLATE = 'mana_layered_navigation/filter_positioning/above_products_template';
    const ABOVE_PRODUCTS_POSITION = 'mana_layered_navigation/filter_positioning/above_products_position';
    const MENU_MIN_WIDTH = 'mana_layered_navigation/filter_positioning/menu_popup_min_width';
    const MENU_MAX_WIDTH = 'mana_layered_navigation/filter_positioning/menu_popup_max_width';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getAboveProductsTemplate() {
        return $this->scopeConfig->getValue(self::ABOVE_PRODUCTS_TEMPLATE);
    }

    public function getAboveProductsPosition() {
        return $this->scopeConfig->getValue(self::ABOVE_PRODUCTS_POSITION);
    }

    public function getMenuMinWidth() {
        return $this->scopeConfig->getValue(self::MENU_MIN_WIDTH);
    }

    public function getMenuMaxWidth() {
        return $this->scopeConfig->getValue(self::MENU_MAX_WIDTH);
    }
}