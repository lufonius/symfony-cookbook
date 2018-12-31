<?php

namespace App\Domains\Recipe\DomainLayer\Repository;

use App\Domains\Core\Interfaces\BaseQueryRequest;

class RecipeIngredientQueryRequest extends BaseQueryRequest {

    private $recipeId;

    public function __construct($id, $recipeId)
    {
        parent::__construct($id, array());

        $this->setRecipeId($recipeId);
    }

    public function getRecipeId()
    {
        return $this->recipeId;
    }

    public function setRecipeId($recipeId): void
    {
        $this->recipeId = $recipeId;
    }

    public function getQueryFilters(): array {
        $parentFilters = parent::getQueryFilters();
        $filters = array();

        if($this->getRecipeId() !== null) {
            $filters['recipe_id'] = $this->getRecipeId();
        }

        return array_merge($parentFilters, $filters);
    }
}