<?php
namespace App\Domains\Core\Interfaces;

use App\Domains\Core\Interfaces\BaseQueryRequest;

interface CollectionInterface {

    public function findById(int $id);

    public function findByQuery(BaseQueryRequest $query): array;

    public function get(): array;

    public function add($entity);

    public function update(int $id, $entity);

    public function upsert(int $id, $entity);

    public function remove(int $id);

}