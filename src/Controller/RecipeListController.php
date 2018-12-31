<?php

namespace App\Controller;

use App\Domains\Recipe\DomainLayer\BusinessLogic\RecipeBusinessLogicInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ViewModel\ViewModelFactory;
use Symfony\Component\HttpFoundation\Response;

class RecipeListController extends AbstractController {

    public function recipeList(ViewModelFactory $viewModelFactory, RecipeBusinessLogicInterface $recipeBusinessLogic) {
        $viewModel = $viewModelFactory->createRecipeListPageViewModel();

        $recipes = $recipeBusinessLogic->getRecipes(array());

        $searchValue = isset($_POST['search']) ? $_POST['search'] : "";
        $viewModel->setSearchInputValue($searchValue);
        $viewModel->setRecipes($recipes);

        return new Response($viewModel->render());
    }

    public function recipeDetail() {

    }
}