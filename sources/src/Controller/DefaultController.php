<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Post;

class DefaultController extends AbstractController
{
    /**
     * this is controller for index page only
     * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
     * @Route("/", name="index_default")
     * @return Response
     */
    public function postList(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findAll();
        return $this->render('default/index.html.twig', [
            'posts' => $posts,
        ]);
    }

};
