<?php

namespace App\Service;

use App\Entity\Post;

/**
 * Class PostExporterHtml
 * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
 * @package App\Service\PostExporter
 */
class PostExporterHtml implements PostExporterInterface
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
        return 'html';
    }

    /**
     * @return string
     */
    public function export()
    {
        $s = '';
        $s .= '<strong>' . $this->post->getName() . '</strong>' . "<br>\n";
        $s .= '<p>' . $this->post->getDescription() . '</p>' . "<br>\n";
        $s .= '<p>' . $this->post->getBody() . '</p>' . "<br>\n";

        return $s;
    }
}
