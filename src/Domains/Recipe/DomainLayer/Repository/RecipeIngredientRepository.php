<?php

namespace App\Domains\Recipe\DomainLayer\Repository;

use App\Domains\Recipe\DomainLayer\Entity\RecipeIngredient;
use App\Domains\Recipe\DomainLayer\Repository\RecipeIngredientRepositoryInterface;
use App\Domains\Recipe\DomainLayer\Repository\RecipeIngredientQueryRequest;
use App\Domains\Core\Interfaces\CollectionInterface;
use App\Domains\Core\Exceptions\RecipeIngredientNotFoundException;
use Exception;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class RecipeIngredientRepository extends ServiceEntityRepository implements RecipeIngredientRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RecipeIngredient::class);
    }

    private function updateRecipeIngredient($id, RecipeIngredient $recipeIngredientToUpdate) {
        $recipeIngredient = $this->find($id);

        try {
            if ($recipeIngredient !== null) {
                $recipeIngredient->setAmountGrams($recipeIngredientToUpdate->getAmountGrams());
                $recipeIngredient->setRecipe($recipeIngredientToUpdate->getRecipe());

                $manager = $this->getEntityManager();
                $manager->persist($recipeIngredient);
                $manager->flush();
            } else {
                throw new RecipeIngredientNotFoundException();
            }
        } catch(Exception $exception) {
            throw $exception;
        }
    }

    private function deleteRecipeIngredient($id) {
        $recipeIngredient = $this->find($id);

        try {
            if($recipeIngredient !== null) {
                $manager = $this->getEntityManager();
                $manager->remove($recipeIngredient);
                $manager->flush();
            } else {
                throw new RecipeIngredientNotFoundException();
            }
        } catch(Exception $exception) {
            throw $exception;
        }
    }

    private function upsertRecipeIngredient(RecipeIngredient $recipeIngredientToUpsert): RecipeIngredient {
        $recipeIngredient = $this->find($recipeIngredientToUpsert->getId());

        if($recipeIngredient !== null) {
            $this->updateRecipeIngredient($recipeIngredient->getId(), $recipeIngredient);
            return $recipeIngredient;
        } else {
            return $this->insertRecipeIngredient($recipeIngredientToUpsert);
        }
    }

    private function insertRecipeIngredient($recipeIngredient): RecipeIngredient {
        $manager = $this->getEntityManager();

        $manager->persist($recipeIngredient);
        $manager->flush();

        return  $recipeIngredient;
    }

    public function getById($id){
        return $this->find($id);
    }

    public function getByCriteria($criteria): array
    {
        return $this->findBy($criteria);
    }

    public function get(): array {
        return $this->findAll();
    }

    public function add($entity): RecipeIngredient
    {
        return $this->insertRecipeIngredient($entity);
    }

    public function remove(int $id)
    {
        $this->deleteRecipeIngredient($id);
    }

    public function update(int $id, $entity)
    {
        $this->updateRecipeIngredient($id, $entity);
    }

    public function upsert($entity)
    {
        return $this->upsertRecipeIngredient($entity);
    }
}
