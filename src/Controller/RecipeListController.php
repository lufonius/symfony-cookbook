<?php

namespace App\Controller;

use App\Domains\Recipe\DomainLayer\BusinessLogic\RecipeBusinessLogicInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ViewModel\ViewModelFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Collections\Criteria;

class RecipeListController extends AbstractController {

    public function recipeList(Request $request, RecipeBusinessLogicInterface $recipeBusinessLogic) {
        $recipes = null;

        $form = $this->createFormBuilder()
            ->add('search', SearchType::class)
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $criteria = $this->searchCriteria($search);
            $recipes = $recipeBusinessLogic->getRecipes($criteria);
        } else {
            $recipes = $recipeBusinessLogic->getRecipes(null);
        }

        $renderedForm = $form->createView();

        return $this->render('pages/recipe-list/recipe-list.html.twig', array(
            'searchForm' => $renderedForm,
            'recipes' => $recipes
        ));
    }

    public function searchCriteria($search) {
        return Criteria::create()
            ->orWhere(Criteria::expr()->contains('title', $search))
            ->orWhere(Criteria::expr()->contains('short_descr', $search))
            ->orWhere(Criteria::expr()->contains('long_descr', $search));
    }
}