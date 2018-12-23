<?php

namespace App\Domains\Recipe\DomainLayer\Aggregation;

use App\Domains\Recipe\DomainLayer\BusinessLogic\RootAggregationInterface;
use App\Domains\Recipe\DomainLayer\Repository\RecipeQueryRequest;
use App\Domains\Recipe\DomainLayer\Entity\Recipe;

class RootAggregation implements RootAggregationInterface {

    public function removeRecipe($id) {}
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