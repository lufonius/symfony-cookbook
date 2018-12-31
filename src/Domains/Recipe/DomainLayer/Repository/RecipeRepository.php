<?php

namespace App\Domains\Recipe\DomainLayer\Repository;

use App\Domains\Recipe\DomainLayer\Entity\Recipe;
use App\Domains\Recipe\DomainLayer\Repository\RecipeRepositoryInterface;
use App\Domains\Core\Exceptions\RecipeNotFoundException;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class RecipeRepository extends ServiceEntityRepository implements RecipeRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    private function updateRecipe($id, Recipe $recipeToUpdate) {
        $recipe = $this->find($id);

        try {
            if ($recipe !== null) {
                $recipe->setTitle($recipeToUpdate->getTitle());
                $recipe->setShortDescr($recipeToUpdate->getShortDescr());
                $recipe->setLongDescr($recipeToUpdate->getLongDescr());
                $recipe->setImageSmall($recipeToUpdate->getImageSmall());
                $recipe->setImageBig($recipeToUpdate->getImageBig());

                $manager = $this->getEntityManager();
                $manager->persist($recipe);
                $manager->flush();
            } else {
                throw new RecipeNotFoundException();
            }
        } catch(Exception $exception) {
            throw $exception;
        }
    }

    private function deleteRecipe($id) {
        $recipe = $this->find($id);

        try {
            if($recipe !== null) {
                $manager = $this->getEntityManager();
                $manager->remove($recipe);
                $manager->flush();
            } else {
                throw new RecipeNotFoundException();
            }
        } catch(Exception $exception) {
            throw $exception;
        }
    }

    private function upsertRecipe(Recipe $recipeToUpsert) {
        $recipe = $this->find($recipeToUpsert->getId());

        if($recipe !== null) {
            $this->updateRecipe($recipe->getId(), $recipe);
            return $recipe;
        } else {
            return $this->insertRecipe($recipe);
        }
    }

    private function insertRecipe($recipe): Recipe {
        $manager = $this->getEntityManager();

        $manager->persist($recipe);
        $manager->flush();

        return  $recipe;
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function getByCriteria(array $criteria): array
    {
        return $this->findBy($criteria);
    }

    public function get(): array {
        return $this->findAll();
    }

    public function add($entity): Recipe
    {
        return $this->insertRecipe($entity);
    }

    public function remove(int $id)
    {
        $this->deleteRecipe($id);
    }

    public function update(int $id, $entity)
    {
        $this->updateRecipe($id, $entity);
    }

    public function upsert($entity)
    {
        return $this->upsertRecipe($entity);
    }
}
