<?php declare(strict_types=1);

namespace Macademy\Minerva\Controller\Faq;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
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
