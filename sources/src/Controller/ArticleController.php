<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article_page")
     * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
     * this is controller for article page that will be used for articles, partner organisations, documents and contacts
     * @return Response
     */
    public function article(): Response
    {
        return $this->render('article/article.html.twig');
    }
};
