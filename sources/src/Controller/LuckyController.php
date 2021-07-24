<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class LuckyController
{
    public function test()
    {
        echo 'Hello';
        die;
    }
}