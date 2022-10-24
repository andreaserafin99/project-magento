<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSettings\Blocks\Adminhtml;

class FilterGridContainer extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Initialize object state with incoming parameters
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'filter';
        $this->_blockGroup = 'Manadev_LayeredNavigationSettings';
        $this->_headerText = __('MANAdev Layered Navigation Filters');
        parent::_construct();
        $this->buttonList->remove('add');
    }
}
