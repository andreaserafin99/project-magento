<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationPositions\Sources;

class AboveProductTemplateSource implements \Magento\Framework\Option\ArrayInterface
{
    protected $aboveProductTemplates = [];

    public function __construct(array $aboveProductTemplates) {
        $this->aboveProductTemplates = $aboveProductTemplates;
    }

    public function toOptionArray()
    {
        $result = [];
        foreach($this->aboveProductTemplates as $key => $value) {
            $result[] = ['value' => $key, 'label' => __($value)];
        }

        return $result;
    }
}