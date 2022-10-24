<?php declare(strict_types=1);

namespace Macademy\Blog\Controller\Post;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Detail implements HttpGetActionInterface{
    private PageFactory $pageFactory;
    private ManagerInterface $eventManager;
    private RequestInterface $request;

    public function __construct(
        PageFactory $pageFactory,
        ManagerInterface $eventManager,
        RequestInterface $request
    ){
        $this->pageFactory = $pageFactory;
        $this->eventManager = $eventManager;
        $this->request = $request;
    }
    public function execute(): Page
    {
        $this->eventManager->dispatch('macademy_blog_post_detail_view', ['request' => $this->request,]);
        return $this->pageFactory->create();
    }
}
