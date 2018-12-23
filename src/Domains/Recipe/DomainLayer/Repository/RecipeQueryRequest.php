<?php
namespace App\Domains\Recipe\DomainLayer\Repository;

use App\Domains\Core\Interfaces\BaseQueryRequest;

class RecipeQueryRequest extends BaseQueryRequest {
    private $title, $shortDescr, $longDescr, $operator;

    public function __construct($id, $title, $shortDescr, $longDescr, $operator, array $orderBy)
    {
        parent::__construct($id, $orderBy);

        $this->setTitle($title);
        $this->setShortDescr($shortDescr);
        $this->setLongDescr($longDescr);
        $this->setOperator($operator);
    }

    public function getOperator()
    {
        return $this->operator;
    }

    public function setOperator($operator): void
    {
        $this->operator = $operator;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getShortDescr()
    {
        return $this->shortDescr;
    }

    public function setShortDescr($shortDescr): void
    {
        $this->shortDescr = $shortDescr;
    }

    public function getLongDescr()
    {
        return $this->longDescr;
    }

    public function setLongDescr($longDescr): void
    {
        $this->longDescr = $longDescr;
    }

    public function getQueryFilters(): array {
        $parentFilters = parent::getQueryFilters();
        $filters = array();

        if($this->getTitle() !== null) {
            $filters['title'] = $this->getTitle();
        }

        if($this->getShortDescr() !== null) {
            $filters['shortDescr'] = $this->getShortDescr();
        }

        if($this->getLongDescr() !== null) {
            $filters['longDescr'] = $this->getLongDescr();
        }

        return array_merge($parentFilters, $filters);
    }
}