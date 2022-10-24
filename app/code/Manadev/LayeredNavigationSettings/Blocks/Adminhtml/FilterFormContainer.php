<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSettings\Blocks\Adminhtml;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Registry;

class FilterFormContainer extends Container
{
    /**
     * @var Registry
     */
    protected $registry;

    public function __construct(Context $context, Registry $registry, array $data = []) {
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize object state with incoming parameters
     *
     * @return void
     */
    protected function _construct()
    {
        /* @var $filter \Manadev\LayeredNavigation\Models\Filter */
        $filter = $this->registry->registry('filter');

        $this->_objectId = 'id';
        $this->_blockGroup = 'Manadev_LayeredNavigationSettings';
        $this->_controller = 'filter';
        $this->_headerText = __('%1 - MANAdev Layered Navigation Filter', $filter->getData('title'));
        parent::_construct();

        if ($this->_authorization->isAllowed('Manadev_LayeredNavigationSettings::filter_save')) {
            $this->buttonList->add('saveandcontinue', [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                    ],
                ]
            ], -100);
        } else {
            $this->buttonList->remove('save');
        }

        $this->removeButton('reset');
        $this->removeButton('delete');
    }

    protected function _buildFormClassName()
    {
        return substr(__CLASS__, 0, strlen(__CLASS__) - strlen('Container'));
    }

}
