<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/", name="index_default")
     * route description for index page
     */
    public function index()
    {
        echo 'Hello World! This is index page';
        die;
    }
}