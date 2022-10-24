<?php declare(strict_types=1);

namespace Macademy\Blog\Api\Data;


/**
 * Blog Post Interface
 * @api
 * @since 1.0.0
 */
interface PostInterface{
    const ID = 'id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const CREATED_AT = 'created_at';

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param $content
     * @return $this
     */
    public function setContent($content);

    /**
     * @return string
     */
    public function getCreatedAt();
}
