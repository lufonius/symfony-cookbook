<?php

namespace App\Domains\Recipe\DomainLayer\Entity;

use Doctrine\ORM\Mapping as ORM;
use \App\Domains\Core\Entity\Ingredient;
use \App\Domains\Recipe\DomainLayer\Entity\Recipe;

/**
 * @ORM\Entity(repositoryClass="App\Domains\Recipe\DomainLayer\Repository\RecipeIngredientRepositoryInterface")
 */
class RecipeIngredient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Domains\Core\Entity\Ingredient")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Domains\Recipe\DomainLayer\Entity\Recipe", inversedBy="ingredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount_grams;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getAmountGrams(): ?int
    {
        return $this->amount_grams;
    }

    public function setAmountGrams(int $amount_grams): self
    {
        $this->amount_grams = $amount_grams;

        return $this;
    }
}
