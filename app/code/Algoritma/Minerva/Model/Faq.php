<?php declare(strict_types=1);

namespace Algoritma\Minerva\Model;

use Algoritma\Minerva\Model\ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Faq extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Faq::class);
    }
}
