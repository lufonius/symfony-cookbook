<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RecipeListController extends AbstractController {
    public function recipeList() {
        $searchValue = (isset($_POST['search'])) ? $_POST['search'] : "";

        return $this->render('views/pages/recipe-list/recipe-list.html.twig', [
            'searchInputValue' => ($searchValue !== null) ? $searchValue : ""
        ]);
    }
}

?>