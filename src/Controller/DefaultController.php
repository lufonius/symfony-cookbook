<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController  {
    public function index() {
        $helloWorld = "Hello World2!";

        return $this->render('default.html.twig', [
           'name' => $helloWorld
        ]);
    }
}

?>