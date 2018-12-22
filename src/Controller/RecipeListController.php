<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class RecipeListController {
    public function recipeList() {
        $helloWorld = "Hello World!";

        return new Response(
            '<h1>'.$helloWorld.'</h1>'
        );
    }
}

?>