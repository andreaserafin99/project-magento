<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSettings\Blocks\Adminhtml;

use Manadev\Core\Blocks\Adminhtml\Form;
use Manadev\Core\Sources\YesNoSource;
use Manadev\LayeredNavigation\Registries\FilterTypes;
use Manadev\LayeredNavigation\Sources\OptionOrderSource;

class FilterForm extends Form
{
    /**
     * @var YesNoSource
     */
    protected $yesNoSource;
    /**
     * @var FilterTypes
     */
    protected $filterTypes;
    /**
     * @var OptionOrderSource
     */
    protected $optionOrderSource;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        YesNoSource $yesNoSource,
        FilterTypes $filterTypes,
        OptionOrderSource $optionOrderSource,
        array $data
    ) {
        parent::__construct($context, $registry, $formFactory, $objectManager, $data);
        $this->yesNoSource = $yesNoSource;
        $this->filterTypes = $filterTypes;
        $this->optionOrderSource = $optionOrderSource;
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setData('id', 'filter_form');
        $this->setData('title', __('Filter Settings'));
    }

    protected function _prepareForm()
    {
        /* @var $filter \Manadev\LayeredNavigation\Models\Filter */
        $filter = $this->_coreRegistry->registry('filter');
        $filterEdit = $this->_coreRegistry->registry('filter_edit');
        $filterDefaults = $this->_coreRegistry->registry('filter_defaults');

        $dbFields = $filter->getFields();

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->createForm([
            'data' => [
                'id' => 'edit_form',
                'action' => $this->getData('action'),
                'method' => 'post',
                'html_id_prefix' => 'filter_',
                'use_container' => true,
                'model' => $filter,
                'edit' => $filterEdit,
            ]
        ]);

        $fieldSet = $form->addFieldset('general_fieldset', [
            'legend' => __('General Settings'),
            'class' => 'fieldset-wide'
        ]);

        $fieldSet->addField('filter_id', 'hidden', ['name' => 'filter_id']);
        $fieldSet->addField('store_id', 'hidden', ['name' => 'store_id']);
        $fieldSet->addField('title', 'text', array_merge($dbFields['title'], [
            'name' => 'title',
            'label' => __('Title'),
            'title' => __('Title'),
            'required' => true,
            'default' => $filterDefaults['title'],
        ]));
        $fieldSet->addField('param_name', 'text', array_merge($dbFields['param_name'], [
            'name' => 'param_name',
            'label' => __('Parameter Name'),
            'title' => __('Parameter Name'),
            'required' => true,
            'class' => 'validate-identifier',
            'default' => $filterDefaults['param_name'],
        ]));
        $fieldSet->addField('position', 'text', array_merge($dbFields['position'], [
            'name' => 'position',
            'label' => __('Position'),
            'title' => __('Position'),
            'required' => true,
            'default' => $filterDefaults['position'],
            'class' => 'validate-number',
        ]));
        $fieldSet->addField('template', 'select', array_merge($dbFields['template'], [
            'name' => 'template',
            'label' => __('Template'),
            'title' => __('Template'),
            'required' => true,
            'options' => $this->filterTypes->get($filter->getData('type'))->getTemplates()->getSource()->getOptions(),
            'default' => $filterDefaults['template'],
        ]));

        $fieldSet = $form->addFieldset('template_fieldset', [
            'legend' => __('Template Settings'),
            'class' => 'fieldset-wide'
        ]);

        $fieldSet->addField('minimum_product_count_per_option', 'select', array_merge($dbFields['minimum_product_count_per_option'], [
            'name' => 'minimum_product_count_per_option',
            'label' => __('Hide Options Having No Products'),
            'title' => __('Hide Options Having No Products'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['minimum_product_count_per_option'],
        ]));

        $fieldSet->addField('hide_filter_with_single_visible_item', 'select', array_merge($dbFields['hide_filter_with_single_visible_item'], [
            'name' => 'hide_filter_with_single_visible_item',
            'label' => __('Hide Filter with Single Visible Item'),
            'title' => __('Hide Filter with Single Visible Item'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['hide_filter_with_single_visible_item'],
        ]));

        if (in_array($filter->getData('type'), ['dropdown', 'swatch'])) {
            $fieldSet->addField('show_selected_options_first', 'select', array_merge($dbFields['show_selected_options_first'], [
                'name' => 'show_selected_options_first',
                'label' => __('Show Selected Options First'),
                'title' => __('Show Selected Options First'),
                'required' => true,
                'options' => $this->yesNoSource->getOptions(),
                'default' => $filterDefaults['show_selected_options_first'],
            ]));
            $fieldSet->addField('sort_options_by', 'select', array_merge($dbFields['sort_options_by'], [
                'name' => 'sort_options_by',
                'label' => __('Sort Options By'),
                'title' => __('Sort Options By'),
                'required' => true,
                'options' => $this->optionOrderSource->getOptions(),
                'default' => $filterDefaults['sort_options_by'],
            ]));

            $fieldSet->addField('use_logical_and', 'select', array_merge($dbFields['use_logical_and'], [
                'name' => 'use_logical_and',
                'label' => __('Use logical AND'),
                'title' => __('Use logical AND'),
                'required' => true,
                'options' => $this->yesNoSource->getOptions(),
                'default' => $filterDefaults['use_logical_and'],
            ]));
        }

        $fieldSet = $form->addFieldset('page_type_fieldset', [
            'legend' => __('Show On the Following Page Types'),
            'class' => 'fieldset-wide'
        ]);

        $fieldSet->addField('is_enabled_in_categories', 'select', array_merge($dbFields['is_enabled_in_categories'], [
            'name' => 'is_enabled_in_categories',
            'label' => __('On Category Pages'),
            'title' => __('On Category Pages'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['is_enabled_in_categories'],
        ]));

        $fieldSet->addField('is_enabled_in_search', 'select', array_merge($dbFields['is_enabled_in_search'], [
            'name' => 'is_enabled_in_search',
            'label' => __('On Quick Search Page'),
            'title' => __('On Quick Search Page'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['is_enabled_in_search'],
        ]));

       $this->assignForm($form, $dbFields, $filterDefaults);

        $form->setValues($filter->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function assignForm($form, $dbFields, $filterDefaults) {
        // placeholder for other modules to add their fields
    }
}