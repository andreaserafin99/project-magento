<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSettings\Controller\Adminhtml\Filter;

use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\LayoutFactory;

class Grid extends AbstractAction
{
    /**
     * @var LayoutFactory
     */
    protected $resultLayoutFactory;

    /**
     * @param Context $context
     * @param LayoutFactory $resultLayoutFactory
     * @internal param PageFactory $resultPageFactory
     */
    public function __construct(Context $context, LayoutFactory $resultLayoutFactory
    ) {
        parent::__construct($context);
        $this->resultLayoutFactory = $resultLayoutFactory;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Manadev_LayeredNavigationSettings::filter_settings');
    }


    public function execute() {
        return $this->resultLayoutFactory->create();
    }

}