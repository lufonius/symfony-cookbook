<?php

namespace App\Domains\Recipe\DomainLayer\Aggregation;

use App\Domains\Recipe\DomainLayer\Aggregation\RecipeRootAggregationInterface;
use App\Domains\Recipe\DomainLayer\Repository\RecipeIngredientQueryRequest;
use App\Domains\Recipe\DomainLayer\Repository\RecipeQueryRequest;

use App\Domains\Recipe\DomainLayer\Entity\Recipe;
use App\Domains\Recipe\DomainLayer\Entity\Step;
use App\Domains\Recipe\DomainLayer\Entity\RecipeIngredient;

use App\Domains\Recipe\DomainLayer\Repository\RecipeRepository;
use App\Domains\Recipe\DomainLayer\Repository\RecipeIngredientRepository;
use App\Domains\Recipe\DomainLayer\Repository\StepQueryRequest;
use App\Domains\Recipe\DomainLayer\Repository\StepRepository;
use Doctrine\ORM\EntityManagerInterface;

class RootAggregation implements RecipeRootAggregationInterface {

    private $recipeRepository;
    private $recipeIngredientRepository;
    private $stepRepository;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->recipeRepository = $entityManager->getRepository(Recipe::class);
        $this->recipeIngredientRepository = $entityManager->getRepository(RecipeIngredient::class);
        $this->stepRepository = $entityManager->getRepository(Step::class);
    }

    public function removeRecipe($recipeId){
        $this->recipeRepository->remove($recipeId);
    }

    public function addRecipe(Recipe $recipe): Recipe {
        return $this->recipeRepository->add($recipe);
    }

    public function getRecipes($criteria){
        return $this->recipeRepository->getByCriteria($criteria);
    }

    public function updateRecipe($recipeId, Recipe $recipe){
        $this->recipeRepository->update($recipeId, $recipe);
    }

    public function findRecipe($recipeId){
        return $this->recipeRepository->getById($recipeId);
    }

    public function updateStep($stepId, Step $step){
        return $this->stepRepository->update($stepId, $step);
    }

    public function removeStep($stepId){
        $this->stepRepository->remove($stepId);
    }

    public function addStep(Step $step){
        return $this->stepRepository->add($step);
    }
    public function findStep($stepId): Step {
        return $this->stepRepository->getById($stepId);
    }

    public function updateRecipeIngredient($recipeIngredientId, RecipeIngredient $recipeIngredient) {
        $this->recipeIngredientRepository->update($recipeIngredientId, $recipeIngredient);
    }
    public function removeRecipeIngredient($recipeIngredientId) {
        $this->recipeIngredientRepository->remove($recipeIngredientId);
    }
    public function addRecipeIngredient(RecipeIngredient $recipeIngredient) {
        return $this->recipeIngredientRepository->add($recipeIngredient);
    }
    public function findRecipeIngredient($recipeIngredientId): RecipeIngredient {
        return $this->recipeIngredientRepository->getById($recipeIngredientId);
    }
}