<?php
namespace App\Domains\Core\Interfaces;

use App\Domains\Core\Interfaces\BaseQueryRequest;

interface CollectionInterface {

    public function getById($id);

    public function getByCriteria(array $criteria): array;

    public function get(): array;

    public function add($entity);

    public function update(int $id, $entity);

    public function upsert($entity);

    public function remove(int $id);

}