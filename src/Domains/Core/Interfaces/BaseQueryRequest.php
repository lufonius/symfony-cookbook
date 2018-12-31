<?php
/*
 * Implement annotation for different kind of ways to filter, ex.: isNull, has, etc.,
 * and also different operators, AND / OR
 * field for the database
 * -> to be created by a factory ...
 * */

namespace App\Domains\Core\Interfaces;

class BaseQueryRequest {
    private $id;
    private $orderBy;

    public function __construct($id, array $orderBy)
    {
        $this->setId($id);
        $this->setOrderBy($orderBy);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getOrderBy()
    {
        return $this->orderBy;
    }

    public function setOrderBy($orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    public function getQueryFilters(): array {
        $filters = array();

        if($this->getId() !== null) {
            $filters['id'] = $this->getId();
        }

        return $filters;
    }
}