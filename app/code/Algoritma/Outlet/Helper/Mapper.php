<?php declare(strict_types=1);

namespace Algoritma\Outlet\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Algoritma\Outlet\Helper\Config;

class Mapper extends AbstractHelper{

    private \Algoritma\Outlet\Helper\Config $configHelper;

    public function __construct(
        Config $configHelper,
        Context $context
    ) {
        parent::__construct($context);
        $this->configHelper = $configHelper;
    }

    public function isCategoryEnabled($data): bool{

        $excludedCategories = $this->configHelper->getOutletExcludedCategories();
        return in_array($data, $excludedCategories);

    }
}
