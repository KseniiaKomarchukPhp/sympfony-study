<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Event\PostSetDataEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Post;
use App\Form\ArticleForm;
use App\Service\PostExporterHtml;
use App\Service\PostExporterCsv;
use App\Service\PostExporterInterface;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ArticleController
 * @package App\Controller
 * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
 */
class ArticleController extends AbstractController
{
    /**
     * this is controller for article page that will be used for articles, partner organisations, documents and contacts
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
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $article = new Post();
        $article->setPublished(new \DateTime());

        $articleForm = $this->createForm(ArticleForm::class, $article);
        $articleForm->handleRequest($request);
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show', [
                'article' => $article->getId(),
            ]);
        }

        return $this->render('article/create.html.twig', [
            'post' => $article,
            'form' => $articleForm->createView(),
        ]);
    }

    /**
     * This function will edit the article
     * @Route ("/article/edit/{article}", name="article_edit")
     * @param Request $request
     * @param Post    $article
     * @return Response
     */
    public function edit(Request $request, Post $article)
    {
        $em = $this->getDoctrine()->getManager();

        $articleForm = $this->createForm(ArticleForm::class, $article);
        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show', [
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
     * @param Post $article
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
     * @param Post $article
     * @return Response
     */
    public function showPostHeader(Post $article)
    {
        return $this->render('article/articleheader.html.twig', [
            'post' => $article,
        ]);
    }

    /**
     * function to delete article from the DB
     * @Route("/delete/{article}", name="article_delete")
     * @param Post                   $article
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Post $article, EntityManagerInterface $em)
    {
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('index_default');
    }

    /**
     * @Route("/download/{article}.csv", name="article_download_csv")
     * @param Post            $article
     * @param PostExporterCsv $exporterCsv
     * @return Response
     */
    public function downloadCsvAction(Post $article, PostExporterCsv $exporterCsv)
    {
        $exporterCsv->setArticle($article);
        $content = $exporterCsv->export();

        $filename = md5($article->getName()) . '.' . $exporterCsv->getFileExtension();

        // Return a response with a specific content
        $response = new Response($content);

        // Create the disposition of the file
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );

        // Set the content disposition
        $response->headers->set('Content-Disposition', $disposition);

        // Dispatch request
        return $response;
    }

    /**
     * @Route("/download/{article}.html", name="article_download_html")
     *
     * @param Post             $article
     * @param PostExporterHtml $exporterHtml
     *
     * @return Response
     */
    public function downloadHtmlAction(Post $article, PostExporterHtml $exporterHtml)
    {
        $exporterHtml->setArticle($article);
        $content = $exporterHtml->export();

        $filename = md5($article->getName()) . '.' . $exporterHtml->getFileExtension();

        // Return a response with a specific content
        $response = new Response($content);

        // Create the disposition of the file
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );

        // Set the content disposition
        $response->headers->set('Content-Disposition', $disposition);

        // Dispatch request
        return $response;
    }

    /**
     * @Route("/download/{article}", name="article_download")
     *
     * @param Post                  $article
     * @param PostExporterInterface $exporter
     *
     * @return Response
     */
    public function downloadAction(Post $article, PostExporterInterface $exporter)
    {
        $exporter->setArticle($article);
        $content = $exporter->export();

        return new Response($content);
    }
};
