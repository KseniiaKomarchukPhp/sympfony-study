<?php

namespace App\Service;

use App\Entity\Post;

/**
 * Class PostExporterCsv
 * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
 * @package App\Service\PostExporter
 */
class PostExporterCsv implements PostExporterInterface
{
    /**
     * @var article
     */
    protected $article;

    /**
     * @param Post $article
     * @return void
     */
    public function setArticle(Post $article)
    {
        $this->post = $article;
    }

    /**
     * @return string
     */
    public function getFileExtension()
    {
        return 'csv';
    }

    /**
     * @return string
     */
    public function export()
    {
        return $this->post->getName() . ';' . $this->post->getDescription() . ';' . $this->post->getBody();
    }
}
