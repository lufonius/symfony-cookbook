<?php
//add interface for the aggregation here since aggregation depends upon business logic
//and not vice versa (business logic is the most protected ... the least to change)
namespace App\Domains\Recipe\DomainLayer\Aggregation;

use \App\Domains\Recipe\DomainLayer\Entity\Recipe;
use \App\Domains\Recipe\DomainLayer\Repository\RecipeQueryRequest;

interface RecipeRootAggregationInterface {

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