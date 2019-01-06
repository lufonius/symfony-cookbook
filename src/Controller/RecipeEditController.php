<?php

namespace App\Controller;

use App\Domains\Recipe\DomainLayer\BusinessLogic\RecipeBusinessLogicInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ViewModel\ViewModelFactory;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Length;

class RecipeEditController extends AbstractController {

    public function editRecipe(Request $request, RecipeBusinessLogicInterface $recipeBusinessLogic) {


        $form = $this->createFormBuilder()
            ->add('title', TextType::class, array(
                'required' => true,
                'constraints' => array(new Length(array('min' => 3)))
            ))
            ->add('submit', SubmitType::class)
            ->getForm();

        $form = $form->handleRequest($request);

        $errors = $form->getErrors(true);

        $renderedForm = $form->createView();

        return $this->render('pages/recipe-edit/recipe-edit.html.twig', array(
            'form' => $renderedForm
        ));
    }
}