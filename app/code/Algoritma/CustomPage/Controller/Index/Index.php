<?php declare(strict_types=1);

namespace Algoritma\CustomPage\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface{
    private PageFactory $pageFactory;

    public function __construct(
        PageFactory $pageFactory
    ){
        $this->pageFactory = $pageFactory;
    }
    public function execute(): Page
    {
        return $this->pageFactory->create();
    }
}
