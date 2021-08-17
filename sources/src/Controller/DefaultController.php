<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Post;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index_default")
     * this is controller for index page only
     * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
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

    /**
     * @Route ("/create", name="default_create")
     * this function create and save new post in the DB
     * @return Response
     */
    public function createPost()
    {
        $post = new Post();
        $post->setName('new post - '.rand(0, 25));
        $post->setDescription('test description');
        $post->setPublished(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return $this->render('article/article2.html.twig', [
            'post' => $post,
        ]);
    }
    /**
     * @Route ("/get", name="get-from-db")
     * @return Response
     */
    public function getPost()
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->find(16);
        return $this->render('article/article2.html.twig', [
            'post' => $post,
            ]);
    }
};
