<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSettings\Controller\Adminhtml\Filter;

use Magento\Backend\App\AbstractAction;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends AbstractAction
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var Context
     */
    protected $context;
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     */
    public function __construct(Context $context, PageFactory $resultPageFactory, Registry $registry) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->context = $context;
        $this->registry = $registry;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Manadev_LayeredNavigationSettings::filter_settings');
    }

    public function execute() {
        $id = $this->context->getRequest()->getParam('id');
        $storeId = $this->context->getRequest()->getParam('store', 0);

        /* @var $filter \Manadev\LayeredNavigation\Models\Filter */
        $filter = $this->_objectManager->create('Manadev\LayeredNavigation\Models\Filter');
        $filter->setData('store_id', $storeId);
        $filter->load($id, 'filter_id');
        $edit = $filter->loadEdit();
        $defaults = $filter->loadDefaults();
        
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $filter->addEditedData($edit, $defaults, $data);
        }

        $this->registry->register('filter', $filter);
        $this->registry->register('filter_edit', $edit);
        $this->registry->register('filter_defaults', $defaults);


        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Manadev_LayeredNavigationSettings::filter_settings');
        $resultPage->getConfig()->getTitle()->prepend((__('%1 - MANAdev Layered Navigation Filter',
            $filter->getData('title'))));

        return $resultPage;
    }
}