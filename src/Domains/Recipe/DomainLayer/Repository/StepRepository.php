<?php

namespace App\Domains\Recipe\DomainLayer\Repository;

use App\Domains\Recipe\DomainLayer\Entity\Step;
use App\Domains\Recipe\DomainLayer\Repository\StepRepositoryInterface;
use App\Domains\Recipe\DomainLayer\Repository\StepQueryRequest;
use App\Domains\Core\Interfaces\CollectionInterface;
use App\Domains\Core\Exceptions\StepNotFoundException;
use App\Domains\Core\Interfaces\BaseQueryRequest;
use Exception;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class StepRepository extends ServiceEntityRepository implements StepRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Step::class);
    }

    private function updateStep($id, Step $stepToUpdate) {
        $step = $this->find($id);

        try {
            if ($step !== null) {
                $step->setTitle($stepToUpdate->getTitle());
                $step->setDescription($stepToUpdate->getDescription());
                $step->setRecipe($stepToUpdate->getRecipe());

                $manager = $this->getEntityManager();
                $manager->persist($step);
                $manager->flush();
            } else {
                throw new StepNotFoundException();
            }
        } catch(Exception $exception) {
            throw $exception;
        }
    }

    private function deleteStep($id) {
        $step = $this->find($id);

        try {
            if($step !== null) {
                $manager = $this->getEntityManager();
                $manager->remove($step);
                $manager->flush();
            } else {
                throw new StepNotFoundException();
            }
        } catch(Exception $exception) {
            throw $exception;
        }
    }

    private function upsertStep(Step $stepToUpsert): Step {
        $step = $this->find($stepToUpsert->getId());

        if($step !== null) {
            $this->updateStep($step->getId(), $step);
            return $step;
        } else {
            return $this->insertStep($stepToUpsert);
        }
    }

    private function insertStep($step): Step {
        $manager = $this->getEntityManager();

        $manager->persist($step);
        $manager->flush();

        return  $step;
    }

    public function getById($id){
        return $this->find($id);
    }

    public function getByCriteria(array $criteria): array
    {
        return $this->findBy($criteria);
    }

    public function get(): array {
        return $this->getStep();
    }

    public function add($entity): Step
    {
        return $this->insertStep($entity);
    }

    public function remove(int $id)
    {
        $this->deleteStep($id);
    }

    public function update(int $id, $entity)
    {
        $this->updateStep($id, $entity);
    }

    public function upsert($entity)
    {
        return $this->upsertStep($entity);
    }
}
