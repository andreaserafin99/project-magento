<?php

namespace Algoritma\Test1\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Store\Model\StoreManagerInterface;

class Index implements HttpGetActionInterface
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    public function __construct(
        StoreManagerInterface $storeManager
    )
    {
        $this->storeManager = $storeManager;
    }

    public function execute()
    {
        return $this->storeManager->getStore()->getCurrentUrl();
    }
}
