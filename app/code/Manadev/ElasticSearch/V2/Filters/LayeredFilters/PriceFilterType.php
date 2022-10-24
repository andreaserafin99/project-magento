<?php

namespace Manadev\ElasticSearch\V2\Filters\LayeredFilters;

use Manadev\ElasticSearch\V2\FilterType;
use Manadev\ProductCollection\Contracts\Filter;
use Manadev\ProductCollection\Filters\LayeredFilters\PriceFilter;

class PriceFilterType extends FilterType
{
    public function apply(Filter $filter) {
        /* @var PriceFilter $filter */
        $field = "{$filter->getName()}_{$this->getCustomerGroupId()}_{$this->getWebsiteId()}";
        if ($filter->getInclusive()) {
            $this->applyInclusiveRange($field, $filter->getRanges()[0]);
        }
        else {
            $this->applyExclusiveRanges($field, $filter->getRanges());
        }
    }
}