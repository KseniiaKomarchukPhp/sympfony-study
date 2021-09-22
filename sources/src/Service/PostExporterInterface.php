<?php

namespace App\Service;

use App\Entity\Post;

/**
 * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
 * Interface PostExporterInterface
 * @package App\Service\PostExporter
 */
interface PostExporterInterface
{
    /**
     * @param Post $article
     * @return void
     */
    public function setArticle(Post $article);

    /**
     * @return string
     */
    public function getFileExtension();

    /**
     * @return string
     */
    public function export();
}
