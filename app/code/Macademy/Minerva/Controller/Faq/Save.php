<?php declare(strict_types=1);

namespace Macademy\Minerva\Controller\Faq;

use Macademy\Minerva\Model\FaqFactory;
use Macademy\Minerva\Model\ResourceModel\Faq as FaqResource;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\Manager;
use Magento\Framework\Search\Request\EmptyRequestDataException;

class Save implements HttpPostActionInterface
{
    private FaqFactory $faqFactory;
    private RequestInterface $request;
    private ResultFactory $resultFactory;
    private FaqResource $faqResource;

    /**
     * @param FaqFactory $faqFactory
     */
    public function __construct(
        Manager $messageManager,
        FaqFactory $faqFactory,
        RequestInterface $request,
        ResultFactory $resultFactory,
        FaqResource $faqResource
    ) {
        $this->faqFactory = $faqFactory;
        $this->request = $request;
        $this->resultFactory = $resultFactory;
        $this->messageManager = $messageManager;
        $this->faqResource = $faqResource;
    }

    public function execute(): Redirect
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        try {
            $question = $this->request->getParam('question');
            if ($question === '' ||
                $question === null) {
                throw new EmptyRequestDataException(__('Fill the field before submit'));
            } else {
                $new_faq = $this->faqFactory->create();
                $new_faq->setData('question', $question);
                $new_faq->setData('customer', $_SESSION['customer_base']['customer_id']);
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $redirect->setUrl('/minerva/faq');
        }

        try {
            $this->faqResource->save($new_faq);
            $this->messageManager->addSuccessMessage(__('The record has been saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('There was a problem saving the record.'));
            return $redirect->setUrl('/minerva/faq');
        }

        return $redirect->setUrl('/minerva/faq');
    }
}
