<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Post;
use App\Form\ArticleForm;

class ArticleController extends AbstractController
{
    /**
     * this is controller for article page that will be used for articles, partner organisations, documents and contacts
     * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
     * @Route("/article", name="article_page")
     * @return Response
     */
    public function article(): Response
    {
        return $this->render('article/article.html.twig');
    }

    /**
     * This function will create new article
     * @Route ("/article/create", name="article_create")
     */
    public function create(Request $request)
    {
        $article = new Post();
        $article->setPublished(new \DateTime());

        $articleForm = $this->createForm(ArticleForm::class, $article);
        $articleForm->handleRequest($request);
        if ($articleForm->isSubmitted() && $articleForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show',[
                'article' => $article->getId(),
            ]);
        }

        return $this->render('article/create.html.twig',[
            'post' => $article,
            'form' => $articleForm->createView(),
        ]);
    }
    /**
     * This function will edit the article
     * @Route ("/article/edit/{article}", name="article_edit")
     */
    public function edit(Request $request, Post $article)
    {
        $em = $this->getDoctrine()->getManager();

        $articleForm = $this->createForm(ArticleForm::class, $article);
        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()){
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show',[
                'article' => $article->getId(),
            ]);

        }
        return $this->render('article/edit.html.twig', [
            'post' => $article,
            'form' => $articleForm->createView(),
        ]);
    }
    /**
     * function to get article from the DB
     * @Route ("/article/show/{article}", name="article_show")
     * @return Response
     */
    public function showPost(Post $article)
    {
        return $this->render('article/show.html.twig', [
            'post' => $article,
        ]);
    }
    /**
     * function to get article from the DB
     * @Route ("/article/showheader/{article}", name="article_show_header")
     * @return Response
     */
    public function showPostHeader (Post $article)
    {
        return $this->render('article/articleheader.html.twig', [
            'post' => $article,
        ]);
    }
};

