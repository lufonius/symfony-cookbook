<?php
namespace App\Domains\Core\Exceptions;

use Exception;

class RecipeNotFoundException extends Exception {
    const EXCEPTION_TRANSLATION_CODE = "EXCEPTION_MESSAGES.RECIPE.NOT_FOUND";
    const CODE = 20001;

    public function __construct()
    {
        parent::__construct(self::EXCEPTION_TRANSLATION_CODE, self::CODE, null);
    }
}