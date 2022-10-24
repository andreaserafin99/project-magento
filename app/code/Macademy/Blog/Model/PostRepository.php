<?php declare(strict_types=1);

namespace Macademy\Blog\Model;

use Macademy\Blog\Api\Data\PostInterface;
use Macademy\Blog\Api\PostRepositoryInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Macademy\Blog\Model\ResourceModel\Post as PostResourceModel;

class PostRepository implements PostRepositoryInterface {

    private PostFactory $postFactory;
    private PostResourceModel $postResourceModel;

    public function __construct(
        PostFactory $postFactory,
        PostResourceModel $postResourceModel)
    {
        $this->postResourceModel = $postResourceModel;
        $this->postFactory = $postFactory;

    }

    public function getById($id): PostInterface
    {
        $post = $this->postFactory->create();
        $this->postResourceModel->load($post, $id);

        if (!$post->getId()) {
            throw new NoSuchEntityException(__('The blog post with "%1" id doesn\'t exist', $id));
        }

        return $post;
    }

    public function save(PostInterface $post): PostInterface
    {
        try{
            $this->postResourceModel->save($post);
            return $post;
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

    }

    public function deleteById($id): bool
    {
        $post = $this->getById($id);

        try{
            $this->postResourceModel->delete($post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;

    }
}
