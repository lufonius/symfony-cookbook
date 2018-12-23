<?php

namespace App\Domains\Recipe\DomainLayer\BusinessLogic;

use App\Domains\Recipe\DomainLayer\BusinessLogic\RecipeBusinessLogicInterface;
use App\Domains\Recipe\DomainLayer\Repository\RecipeQueryRequest;
use App\Domains\Recipe\DomainLayer\Entity\Recipe;

class BusinessLogic implements RecipeBusinessLogicInterface {

    public function removeRecipe($id) {
        $test = "test";
    }
    public function addRecipe(Recipe $recipe) {}
    public function findRecipeByQuery(RecipeQueryRequest $query) {}
    public function updateRecipe($id, Recipe $recipe) {}
    public function getRecipeWithInfos($id) {}


    public function updateRecipeStep($id, $title, $description) {}
    public function assignRecipeStepToRecipe() {}
    public function dissociateRecipeStepFromRecipe() {}


    public function updateRecipeIngredient($amount) {}
    public function assignRecipeIngredientToRecipe() {}
    public function dissociateRecipeIngredientFromRecipe() {}
}