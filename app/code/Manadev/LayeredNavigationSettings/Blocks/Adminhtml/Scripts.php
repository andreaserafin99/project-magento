<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSettings\Blocks\Adminhtml;

use Magento\Backend\Block\Template;

class Scripts extends Template
{
    protected $_scripts = [];

    public function addScript($scriptName, $config = array(), $target = '*') {
        if (!isset($this->_scripts[$target])) {
            $this->_scripts[$target] = [];
        }

        $this->_scripts[$target][$scriptName] = $config;

        return $this;
    }

    public function renderScripts() {
        return json_encode($this->_scripts, JSON_PRETTY_PRINT);
    }

    public function getScripts() {
        return $this->_scripts;
    }
}