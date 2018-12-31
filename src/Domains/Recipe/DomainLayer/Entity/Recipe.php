<?php

namespace App\Domains\Recipe\DomainLayer\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domains\Recipe\DomainLayer\Repository\RecipeRepositoryInterface")
 */
class Recipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $short_descr;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $long_descr;

    /**
     * @ORM\Column(type="blob")
     */
    private $image_small;

    /**
     * @ORM\Column(type="blob")
     */
    private $image_big;

    /**
     * @ORM\OneToMany(targetEntity="App\Domains\Recipe\DomainLayer\Entity\RecipeIngredient", mappedBy="recipe", orphanRemoval=true)
     */
    private $ingredients;

    /**
     * @ORM\OneToMany(targetEntity="App\Domains\Recipe\DomainLayer\Entity\Step", mappedBy="recipe", orphanRemoval=true)
     */
    private $steps;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->steps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipeId(): ?int
    {
        return $this->recipe_id;
    }

    public function setRecipeId(int $recipe_id): self
    {
        $this->recipe_id = $recipe_id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescr(): ?string
    {
        return $this->short_descr;
    }

    public function setShortDescr(?string $short_descr): self
    {
        $this->short_descr = $short_descr;

        return $this;
    }

    public function getLongDescr(): ?string
    {
        return $this->long_descr;
    }

    public function setLongDescr(?string $long_descr): self
    {
        $this->long_descr = $long_descr;

        return $this;
    }

    public function getImageSmall()
    {
        return $this->image_small;
    }

    public function setImageSmall($image_small): self
    {
        $this->image_small = $image_small;

        return $this;
    }

    public function getImageBig()
    {
        return $this->image_big;
    }

    public function setImageBig($image_big): self
    {
        $this->image_big = $image_big;

        return $this;
    }

    /**
     * @return Collection|RecipeIngredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(RecipeIngredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(RecipeIngredient $ingredient): self
    {
        if ($this->ingredients->contains($ingredient)) {
            $this->ingredients->removeElement($ingredient);
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecipe() === $this) {
                $ingredient->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Step[]
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Step $step): self
    {
        if (!$this->steps->contains($step)) {
            $this->steps[] = $step;
            $step->setRecipe($this);
        }

        return $this;
    }

    public function removeStep(Step $step): self
    {
        if ($this->steps->contains($step)) {
            $this->steps->removeElement($step);
            // set the owning side to null (unless already changed)
            if ($step->getRecipe() === $this) {
                $step->setRecipe(null);
            }
        }

        return $this;
    }
}
