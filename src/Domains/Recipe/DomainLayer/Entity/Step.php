<?php

namespace App\Domains\Recipe\DomainLayer\Entity;

use Doctrine\ORM\Mapping as ORM;
use \App\Domains\Recipe\DomainLayer\Entity\Recipe;

/**
 * @ORM\Entity(repositoryClass="App\Domains\Recipe\DomainLayer\Repository\StepRepositoryInterface")
 */
class Step
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Domains\Recipe\DomainLayer\Entity\Recipe", inversedBy="steps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $chronology;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getChronology(): ?int
    {
        return $this->chronology;
    }

    public function setChronology(int $chronology): self
    {
        $this->chronology = $chronology;

        return $this;
    }
}
