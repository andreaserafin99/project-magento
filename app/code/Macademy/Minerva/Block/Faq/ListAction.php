<?php declare(strict_types=1);

namespace Macademy\Minerva\Block\Faq;

use Macademy\Minerva\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ListAction implements ArgumentInterface
{
    private CollectionFactory $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collection = $collectionFactory->create();
        $this->collectionFactory = $collectionFactory;
    }

    public function getDataList()
    {
        $counter = 0;
        $result = $this->collection->getItemsByColumnValue('is_published', '1');
        if (array_key_exists('customer_id', $_SESSION['customer_base'])) {
            foreach ($this->collection->getItemsByColumnValue('customer', $_SESSION['customer_base']['customer_id']) as $item) {
                if ($item->getData('is_published') !== '1') {
                    array_push($result, $item);
                }
            }
        }
        return $result;
    }
}
