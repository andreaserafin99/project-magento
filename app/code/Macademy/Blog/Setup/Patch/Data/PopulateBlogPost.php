<?php declare(strict_types=1);

namespace Macademy\Blog\Setup\Patch\Data;

use Macademy\Blog\Api\PostRepositoryInterface;
use Macademy\Blog\Model\PostFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class PopulateBlogPost implements DataPatchInterface{

    private ModuleDataSetupInterface $moduleDataSetup;
    private PostFactory $postFactory;
    private PostRepositoryInterface $postRepository;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PostFactory $postFactory,
        PostRepositoryInterface $postRepository
    ){

        $this->moduleDataSetup = $moduleDataSetup;
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

            $post = $this->postFactory->create();
            $post->setData([
                'title' => 'An awesome post1 ',
                'content' => 'This is totally awesome pt.2!',
            ]);
            $this->postRepository->save($post);

        $this->moduleDataSetup->endSetup();
    }
}
