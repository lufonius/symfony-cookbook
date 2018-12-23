<?php

namespace App\Domains\Recipe\DomainLayer\Repository;

use App\Domains\Recipe\DomainLayer\Entity\Recipe;
use App\Domains\Core\Interfaces\BaseQueryRequest;
use App\Domains\Core\Interfaces\CollectionInterface;
use App\Domains\Core\Exceptions\RecipeNotFoundException;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class RecipeRepository extends ServiceEntityRepository implements CollectionInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    private function getRecipes(RecipeQueryRequest $query): array
    {
        $queryBuilder = $this->createQueryBuilder('recipe');

        foreach($query->getQueryFilters() as $key => $value) {
            $queryBuilder = $queryBuilder
                ->orWhere('recipe.'.$key.' = :'.$key)
                ->setParameter($key, $value);
        }

        return $queryBuilder
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    private function findRecipe($id): Recipe {
        return $this
            ->createQueryBuilder('recipe')
            ->andWhere('recipe.id = $id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    private function updateRecipe($id, Recipe $recipeToUpdate) {
        $recipe = $this->findRecipe($id);

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
        $recipe = $this->findRecipe($id);

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
        $recipe = $this->findRecipe($recipeToUpsert->getId());

        if($recipe !== null) {
            $this->updateRecipe($recipe->getId(), $recipe);
        } else {

        }
    }

    private function insertRecipe($recipe): Recipe {
        $manager = $this->getEntityManager();

        $manager->persist($recipe);
        $manager->flush();

        return  $recipe;
    }

    public function findById(int $id){
        return $this->findRecipe($id);
    }

    public function findByQuery(BaseQueryRequest $query): array
    {
        return $this->getRecipes($query);
    }

    public function get(): array {
        return $this->getRecipes();
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

    public function upsert(int $id, $entity)
    {
        $this->upsertRecipe($entity);
    }
}
