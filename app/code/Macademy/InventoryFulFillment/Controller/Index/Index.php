<?php declare(strict_types=1);

namespace Macademy\InventoryFulFillment\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    private PageFactory $pageFactory;

    /**
     * @param PageFactory $pageFactory
     * @return void
     */
    public function __construct(
        PageFactory $pageFactory
    ) {

        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set(__('Shipping Plan'));
        return $page;
    }
}
