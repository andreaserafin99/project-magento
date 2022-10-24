<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationSettings\Resources\Collections;

use Magento\Framework\App\Action\Context;
use Manadev\LayeredNavigation\Resources\Collections\FilterCollection;

class FilterGridCollection extends FilterCollection {
    /**
     * @var Context
     */
    protected $context;

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        Context $context,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    )
    {
        $this->context = $context;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $context->getEventManager(), $connection, $resource);
    }

    /**
     * @return $this
     */
    protected function _initSelect() {
        parent::_initSelect();

        if ($storeId = $this->context->getRequest()->getParam('store')) {
            $this->storeSpecific($storeId);
        }
        else {
            $this->systemWide();
        }

        return $this;
    }
}