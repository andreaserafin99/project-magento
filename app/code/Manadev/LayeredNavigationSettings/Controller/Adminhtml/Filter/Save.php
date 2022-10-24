<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSettings\Controller\Adminhtml\Filter;

use Magento\Backend\App\AbstractAction;
use Magento\Framework\App\ResponseInterface;
use Magento\Backend\App\Action\Context;

class Save extends AbstractAction
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @param Context $context
     */
    public function __construct(Context $context) {
        parent::__construct($context);
        $this->context = $context;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Manadev_LayeredNavigationSettings::filter_save');
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute() {
        $id = $this->context->getRequest()->getParam('filter_id');
        $storeId = $this->context->getRequest()->getParam('store_id', 0);
        $redirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        /* @var $filter \Manadev\LayeredNavigation\Models\Filter */
        $filter = $this->_objectManager->create('Manadev\LayeredNavigation\Models\Filter');
        $filter->setData('store_id', $storeId);
        $filter->load($id, 'filter_id');

        try {
            $filter->edit($data);
            $this->messageManager->addSuccess(__('Filter settings have been saved.'));
        }
        catch(\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
            $this->_getSession()->setFormData($data);

            return $redirect->setPath('*/*/edit', ['id' => $id, 'store' => $storeId, '_current' => true]);
        }

        if($this->getRequest()->getParam('back') == "edit") {
            return $redirect->setPath('*/*/edit', ['id' => $id, 'store' => $storeId]);
        }
        else {
            return $redirect->setPath('*/*/', ['store' => $storeId]);
        }
    }
}