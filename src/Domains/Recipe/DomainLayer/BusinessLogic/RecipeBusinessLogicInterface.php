<?php
/*
 * - the businesslogic handels all rules and creates more specific use-cases,
 *   primitive example: a user in the role 'admin' can delete
 *   all recipes, a normal user can only the ones he owns
 *
 * - more precise exception handling
 * */
namespace App\Domains\Recipe\DomainLayer\BusinessLogic;

use \App\Domains\Recipe\DomainLayer\Entity\Recipe;
use App\Domains\Recipe\DomainLayer\Entity\RecipeIngredient;
use \App\Domains\Recipe\DomainLayer\Entity\Step;
use \App\Domains\Recipe\DomainLayer\Repository\RecipeQueryRequest;

interface RecipeBusinessLogicInterface {

    public function removeRecipe($recipeId);
    public function addRecipe(Recipe $recipe);
    public function getRecipes(array $criteria);
    public function updateRecipe($recipeId, Recipe $recipe);
    public function getRecipeWithInfos($recipeId);

    //businesslogic protects step to be associated to another recipe
    //after creation
    public function updateStep($stepId, $title, $description);
    //a.k.a create, making sure recipeId is provided
    public function assignStepToRecipe($recipeId, Step $step): Step;
    //a.k.a delete
    public function dissociateStepFromRecipe($stepId);

    //only amount can be changed
    public function updateRecipeIngredient($recipeIngredientId, $amountGrams);
    //a.k.a create, making sure recipeId is provided
    public function assignRecipeIngredientToRecipe($recipeId, RecipeIngredient $recipeIngredient): RecipeIngredient;
    //a.k.a delete
    public function dissociateRecipeIngredientFromRecipe($recipeIngredientId);
}