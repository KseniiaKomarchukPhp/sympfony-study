<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article_page")
     * this is controller for article page that will be used for articles, partner organisations, documents and contacts
     */
    public function article()
    {
        return $this->render('article/article.html.twig');
    }
}