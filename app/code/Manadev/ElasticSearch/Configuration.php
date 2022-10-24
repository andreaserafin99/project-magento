<?php

namespace Manadev\ElasticSearch;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Configuration
{
    const ELASTIC_QUERY_LOGGING = 'mana_core/log/elastic_queries';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function isElasticQueryLoggingEnabled() {
        return $this->scopeConfig->isSetFlag(static::ELASTIC_QUERY_LOGGING);
    }

}