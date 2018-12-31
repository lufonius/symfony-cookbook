<?php
/*
 * this file aggregates all of the entities, ex.: getting a recipe with all ingredients and
 * steps
 * */
namespace App\Domains\Recipe\DomainLayer\Aggregation;

use \App\Domains\Recipe\DomainLayer\Entity\Recipe;
use \App\Domains\Recipe\DomainLayer\Entity\RecipeIngredient;
use \App\Domains\Recipe\DomainLayer\Entity\Step;
use \App\Domains\Recipe\DomainLayer\Repository\RecipeQueryRequest;

interface RecipeRootAggregationInterface {

    public function removeRecipe($recipeId);
    public function addRecipe(Recipe $recipe);
    public function getRecipes(array $criteria);
    public function updateRecipe($recipeId, Recipe $recipe);
    public function findRecipe($recipeId);

    public function updateStep($stepId, Step $step);
    public function removeStep($stepId);
    public function addStep(Step $step);
    public function findStep($stepId): Step;

    public function updateRecipeIngredient($recipeIngredientId, RecipeIngredient $recipeIngredient);
    public function removeRecipeIngredient($recipeIngredientId);
    public function addRecipeIngredient(RecipeIngredient $recipeIngredient);
    public function findRecipeIngredient($recipeIngredientId): RecipeIngredient;

}