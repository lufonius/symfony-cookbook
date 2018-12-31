<?php

namespace App\ViewModel;

use App\ViewModel\ViewModelInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

class RecipeListPageViewModel implements ViewModelInterface{
    private $twig;
    private $translator;
    private $template = "views/pages/recipe-list/recipe-list.html.twig";

    private $searchForm = array(
        "input" => array(
            "value" => "",
            "placeholder" => ""
        ),
        "submit" => array(
            "label" => ""
        )
    );

    private $recipes;

    public function __construct(EngineInterface $twig, TranslatorInterface $translator)
    {
        $this->twig = $twig;
        $this->translator = $translator;

        $this->setSearchInputPlaceholder('PAGES.RECIPE_LIST.SEARCH_FORM.INPUT_PLACEHOLDER');
        $this->setSearchButtonLabel('PAGES.RECIPE_LIST.SEARCH_FORM.BUTTON_LABEL');
    }

    public function setSearchInputValue($value) {
        $this->searchForm['input']['value'] = $value;
    }

    private function setSearchInputPlaceholder($value) {
        $this->searchForm['input']['placeholder'] = $this->translator->trans($value);
    }

    private function setSearchButtonLabel($value) {
        $this->searchForm['submit']['label'] = $this->translator->trans($value);
    }

    public function getRecipes()
    {
        return $this->recipes;
    }

    public function setRecipes($recipes): void
    {
        $this->recipes = $recipes;
    }

    public function render(): string {

        $array = array();
        foreach($this as $key => $value) {
            $array[$key] = $value;
        }

        return $this->twig->render($this->template, $array);
    }
}