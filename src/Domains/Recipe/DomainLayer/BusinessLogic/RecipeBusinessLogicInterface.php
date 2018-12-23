<?php
namespace App\Domains\Recipe\DomainLayer\BusinessLogic;

use \App\Domains\Recipe\DomainLayer\Entity\Recipe;
use \App\Domains\Recipe\DomainLayer\Repository\RecipeQueryRequest;

interface RecipeBusinessLogicInterface {

    public function removeRecipe($id);
    public function addRecipe(Recipe $recipe);
    public function findRecipeByQuery(RecipeQueryRequest $query);
    public function updateRecipe($id, Recipe $recipe);
    public function getRecipeWithInfos($id);


    public function updateRecipeStep($id, $title, $description);
    public function assignRecipeStepToRecipe();
    public function dissociateRecipeStepFromRecipe();


    public function updateRecipeIngredient($amount);
    public function assignRecipeIngredientToRecipe();
    public function dissociateRecipeIngredientFromRecipe();
}