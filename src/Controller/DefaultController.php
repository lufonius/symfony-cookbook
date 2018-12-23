<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Domains\Recipe\DomainLayer\BusinessLogic\RecipeBusinessLogicInterface;

class DefaultController extends AbstractController  {
    public function index(RecipeBusinessLogicInterface $recipeBusinessLogic) {

        $recipeBusinessLogic->removeRecipe(12);

        $helloWorld = "Hello World2!";

        return $this->render('views/default.html.twig', [
           'name' => $helloWorld
        ]);
    }
}

?>