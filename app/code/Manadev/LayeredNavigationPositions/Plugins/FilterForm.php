<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationPositions\Plugins;

use Manadev\Core\Features;
use Manadev\Core\Forms\Form;
use Manadev\LayeredNavigationSettings\Blocks\Adminhtml\FilterForm as FilterFormBlock;
use Manadev\Core\Sources\YesNoSource;

class FilterForm
{
    /**
     * @var YesNoSource
     */
    protected $yesNoSource;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(YesNoSource $yesNoSource, Features $features) {
        $this->yesNoSource = $yesNoSource;
        $this->features = $features;
    }
    
    public function beforeAssignForm(FilterFormBlock $block, Form $form, $dbFields, $filterDefaults) {
        if (!$this->features->isEnabled(__CLASS__, 0)) {
            return;
        }

        if (!($fieldSet = $form->getElement('positioning_fieldset'))) {
            $fieldSet = $form->addFieldset('positioning_fieldset', [
                'legend' => __('Show Filters In Following Positions'),
                'class' => 'fieldset-wide',
            ], 'template_fieldset');
        }

        $fieldSet->addField('show_in_main_sidebar', 'select', array_merge($dbFields['show_in_main_sidebar'], [
            'name' => 'show_in_main_sidebar',
            'label' => __('In Main Sidebar'),
            'title' => __('In Main Sidebar'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['show_in_main_sidebar'],
        ]));

        $fieldSet->addField('show_in_additional_sidebar', 'select', array_merge($dbFields['show_in_additional_sidebar'], [
            'name' => 'show_in_additional_sidebar',
            'label' => __('In Additional Sidebar'),
            'title' => __('In Additional Sidebar'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['show_in_additional_sidebar'],
        ]));

        $fieldSet->addField('show_above_products', 'select', array_merge($dbFields['show_above_products'], [
            'name' => 'show_above_products',
            'label' => __('Above Products'),
            'title' => __('Above Products'),
            'required' => true,
            'options' => $this->yesNoSource->getOptions(),
            'default' => $filterDefaults['show_above_products'],
        ]));

    }
}