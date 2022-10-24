<?php declare(strict_types=1);

namespace Algoritma\Minerva\Model\ResourceModel\Faq;

use Algoritma\Minerva\Model\Faq;
use Algoritma\Minerva\Model\ResourceModel\Faq as FaqResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Faq::class, FaqResourceModel::class);
    }
}
