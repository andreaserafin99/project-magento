<?php
namespace Algoritma\Outlet\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Serialize\SerializerInterface;

class Config extends AbstractHelper {
    protected SerializerInterface $serializer;

    public function __construct(
        Context $context,
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
        parent::__construct($context);
    }

    public function getOutletExcludedCategories(){
        $outletCategories = $this->scopeConfig->getValue(
            'outlet/excluded_categories/excluded_categories_input',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return explode(',' , $outletCategories);
    }
}
