<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index_default")
     * this is controller for index page only
     * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }
};
