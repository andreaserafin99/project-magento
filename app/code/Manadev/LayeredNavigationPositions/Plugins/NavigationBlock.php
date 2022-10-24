<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationPositions\Plugins;

use Manadev\LayeredNavigation\Blocks\Navigation;
use Manadev\LayeredNavigationPositions\Configuration;

class NavigationBlock
{
    /**
     * @var Configuration
     */
    protected $configuration;

    public function __construct(Configuration $configuration) {
        $this->configuration = $configuration;
    }

    public function afterSetLayout(
        Navigation $subject,
        $result
    ){
        if(
            $subject->getData('position') == "show_above_products" &&
            $template = $this->configuration->getAboveProductsTemplate()
        ) {
            $subject->setTemplate($template);

            if ($subject->getPosition() == "show_above_products" && $this->isDropdownMenu()) {
                $config = [
                    'menu_min_width' => $this->configuration->getMenuMinWidth(),
                    'menu_max_width' => $this->configuration->getMenuMaxWidth(),
                ];
                $subject->addScript("mana_layerednavigationpositions", $config, ".mana-filter-block-above-menu");
            }
        }
        return $result;
    }

    /**
     * @return bool
     */
    protected function isDropdownMenu() {
        return $this->configuration->getAboveProductsTemplate() == "Manadev_LayeredNavigationPositions::horizontal/menu.phtml";
    }
}