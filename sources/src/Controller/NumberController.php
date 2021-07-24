<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class NumberController
{
    public function number()
    {
        echo 'Hello number!';
        die;
    }
}