<?php

namespace App\ViewModel;

use App\ViewModel\RecipeListPageViewModel;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

class ViewModelFactory {

    private $twig;
    private $translator;

    public function __construct(EngineInterface $twig, TranslatorInterface $translator)
    {
        $this->twig = $twig;
        $this->translator = $translator;
    }

    public function createRecipeListPageViewModel(): RecipeListPageViewModel {
        $viewModel = new RecipeListPageViewModel($this->twig, $this->translator);

        return $viewModel;
    }
}