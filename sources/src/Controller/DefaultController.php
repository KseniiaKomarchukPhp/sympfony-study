<?php
namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PostRepository;
use App\Entity\Post;

class DefaultController extends AbstractController
{

    /**
     * this is controller for index page only
     * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
     * @Route("/", name="index_default")
     * @param PostRepository $postRepository
     * @return Response
     */
    public function postList(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        return $this->render('default/index.html.twig', [
            'posts' => $posts,
        ]);
    }
};
