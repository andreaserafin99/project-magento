<?php declare(strict_types=1);

namespace Macademy\Blog\ViewModel;
use Macademy\Blog\Api\Data\PostInterface;
use Macademy\Blog\Api\PostRepositoryInterface;
use Macademy\Blog\Model\ResourceModel\Post\Collection;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Block\ArgumentInterface;


class Post implements ArgumentInterface{

    private Collection $collection;
    private PostRepositoryInterface $postRepository;
    private RequestInterface $request;

    public function __construct(
        Collection $collection,
        PostRepositoryInterface $postRepository,
        RequestInterface $request
    )
    {
        $this->collection = $collection;
        $this->postRepository = $postRepository;
        $this->request = $request;
    }

    /**
     * @return DataObject[]
     */
    public function getList(): array{

        return $this->collection->getItems();

    }

    /**
     * @return int
     */
    public function getCount(): int {
        return $this->collection->count();
    }


    public function getId(): int{
        return (int) $this->request->getParam('id');
    }

    public function getDetail(): PostInterface{

        $id = (int) $this->request->getParam('id');
        return $this->postRepository->getById($id);
    }
}
