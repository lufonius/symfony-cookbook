<?php

namespace App\Domains\Recipe\DomainLayer\BusinessLogic;

use App\Domains\Recipe\DomainLayer\BusinessLogic\RecipeBusinessLogicInterface;
use App\Domains\Recipe\DomainLayer\Aggregation\RecipeRootAggregationInterface;
use App\Domains\Recipe\DomainLayer\Repository\RecipeQueryRequest;
use App\Domains\Recipe\DomainLayer\Entity\Recipe;
use App\Domains\Recipe\DomainLayer\Entity\RecipeIngredient;
use App\Domains\Recipe\DomainLayer\Entity\Step;
use App\Domains\Core\Exceptions\StepNotFoundException;
use App\Domains\Core\Exceptions\RecipeIngredientNotFoundException;


class BusinessLogic implements RecipeBusinessLogicInterface {

    private $rootAggregation;

    public function __construct(RecipeRootAggregationInterface $rootAggregation)
    {
        $this->rootAggregation = $rootAggregation;
    }

    public function removeRecipe($recipeId) {
        $this->rootAggregation->removeRecipe($recipeId);
    }

    public function getRecipes(array $criteria) {
        return $this->rootAggregation->getRecipes($criteria);
    }

    public function addRecipe(Recipe $recipe) {
        $this->rootAggregation->addRecipe($recipe);
    }

    public function findRecipeByQuery(RecipeQueryRequest $query) {
        $this->rootAggregation->findRecipeByQuery($query);
    }

    public function updateRecipe($recipeId, Recipe $recipe) {
        $this->rootAggregation->updateRecipe($recipeId, $recipe);
    }

    //calculate the kcal
    public function getRecipeWithInfos($recipeId) {
        $this->rootAggregation->getRecipeWithInfos($recipeId);
    }


    public function updateStep($stepId, $title, $description) {
        try {
            $step = $this->rootAggregation->findStep($stepId);
            if($step !== null) {
                $step->setTitle($title);
                $step->setDescription($description);
                $this->rootAggregation->updateStep($stepId, $step);
            } else {
                throw new StepNotFoundException();
            }
        } catch(\Exception $exception) {

        }
    }

    //a.k.a create, making sure recipeId is provided
    public function assignStepToRecipe($recipeId, Step $step): Step {
        $step->setRecipe($recipeId);

        return $this->rootAggregation->addStep($step);
    }
    //a.k.a delete
    public function dissociateStepFromRecipe($stepId) {
        $this->rootAggregation->removeStep($stepId);
    }

    //only amount can be changed
    public function updateRecipeIngredient($recipeIngredientId, $amountGrams) {
        try {
            $recipeIngredient = $this->rootAggregation->findRecipeIngredient($recipeIngredientId);
            if($recipeIngredient !== null) {
                $recipeIngredient->setAmountGrams($amountGrams);
                $this->rootAggregation->updateRecipeIngredient($recipeIngredientId, $recipeIngredient);
            } else {
                throw new RecipeIngredientNotFoundException();
            }

        } catch(\Exception $exception) {

        }
    }

    //a.k.a create, making sure recipeId is provided
    public function assignRecipeIngredientToRecipe($recipeId, RecipeIngredient $recipeIngredient): RecipeIngredient {
        $recipeIngredient->setRecipe($recipeId);
        return $this->rootAggregation->addRecipeIngredient($recipeIngredient);
    }
    //a.k.a delete
    public function dissociateRecipeIngredientFromRecipe($recipeIngredientId) {
        $this->rootAggregation->removeRecipeIngredient($recipeIngredientId);
    }
}