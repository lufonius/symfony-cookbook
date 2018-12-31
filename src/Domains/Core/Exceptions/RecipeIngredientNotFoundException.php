<?php
namespace App\Domains\Core\Exceptions;

use Exception;

class RecipeIngredientNotFoundException extends Exception {
    const EXCEPTION_TRANSLATION_CODE = "EXCEPTION_MESSAGES.RECIPE_INGREDIENT.NOT_FOUND";
    const CODE = 20002;

    public function __construct()
    {
        parent::__construct(self::EXCEPTION_TRANSLATION_CODE, self::CODE, null);
    }
}