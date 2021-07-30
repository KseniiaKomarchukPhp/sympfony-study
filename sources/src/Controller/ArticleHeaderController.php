<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleHeaderController extends AbstractController
{
    /**
     * @Route("/articleheader", name="article_header")
     * this is controller for article page with header block, that will be used for Ranking and calendar tabs
     */
    public function articleheader()
    {
        return $this->render('article/articleheader.html.twig');
    }
}