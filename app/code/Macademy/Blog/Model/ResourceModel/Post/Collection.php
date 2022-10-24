<?php declare(strict_types=1);

namespace Macademy\Blog\Model\ResourceModel\Post;

use Macademy\Blog\Model\Post;
use Magento\CatalogImportExport\Model\Import\Proxy\Product\ResourceModel;
use Macademy\Blog\Model\ResourceModel\Post as PostResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {
    protected function _construct()
    {
        $this->_init(Post::class, PostResourceModel::class);
    }
}
