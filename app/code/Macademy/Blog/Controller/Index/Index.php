<?php declare(strict_types=1);

namespace Macademy\Blog\Controller\Index;


use Magento\Framework\Controller\Result\Forward;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Index implements HttpGetActionInterface{
    private ForwardFactory $forwardFactory;

    public function __construct(
        ForwardFactory $forwardFactory
    )
    {
        $this->forwardFactory = $forwardFactory;
    }

    public function execute(): Forward
    {
        $forward = $this->forwardFactory->create();
        return $forward->setController('post')->forward('list');
    }
}
