<?php

namespace Manadev\ElasticSearch\V2\Filters;

use Magento\Elasticsearch\Model\Adapter\FieldMapperInterface;
use Manadev\ElasticSearch\V2\FilterType;
use Manadev\ProductCollection\Contracts\Filter;
use Manadev\ProductCollection\Filters\SearchFilter;

class SearchFilterType extends FilterType
{
    /**
     * @param Filter|SearchFilter $filter
     */
    public function apply(Filter $filter) {
        $fields = $this->getSearchRequestConfig()->get('quick_search_container/queries/search/match');

        $count = 0;
        $value = preg_replace('#^"(.*)"$#m', '$1', $filter->getText(), -1, $count);
        $condition = ($count) ? 'match_phrase' : 'match';

        $should = [];
        foreach ($fields as $field) {
            $name = $field['field'] != '*'
                ? $this->getElasticFieldMapper()->getFieldName($field['field'],
                    ['type' => FieldMapperInterface::TYPE_QUERY])
                : '_all';

            if (mb_strpos($name, 'position_') === 0) {
                // full text search doesn't make sense on a position field
                // and it fails if tried
                continue;
            }

            $should[] = [
                $condition => [
                    $name => [
                        'query' => $value,
                        'boost' => ($field['boost'] ?? 1) + 1,
                    ],
                ],
            ];
        }

        $this->getQuery()->body['query']['bool']['filter'][1]['terms']['visibility'][0] = '3';
        $this->getQuery()->body = array_merge_recursive($this->getQuery()->body, [
            'query' => [
                'bool' => [
                    'should' => $should,
                    'minimum_should_match' => 1,
                ],
            ],
        ]);
    }
}
