<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationPositions\Sources;

use Manadev\Core\Source;

class AboveProductsPosition extends Source
{
    const ABOVE_PRODUCTS = 'above_products';
    const BELOW_DESCRIPTION = 'below_description';

    public function getOptions() {
        return [
            static::ABOVE_PRODUCTS => __('Above Products'),
            static::BELOW_DESCRIPTION => __('Below Description'),
        ];
    }
}