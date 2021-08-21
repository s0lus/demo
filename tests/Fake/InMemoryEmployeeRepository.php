<?php

declare(strict_types=1);

namespace App\Tests\Fake;

use App\Entity\Employee;

final class InMemoryEmployeeRepository implements \App\Repository\EmployeeRepositoryInterface
{
    private array $elements;

    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }

    public function findAll()
    {
        return $this->elements;
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        usort($this->elements, static function (Employee $employee1, Employee $employee2) {
            return $employee1->getSalary() < $employee2->getSalary() ? 1 : -1;
        });

        return $this->elements;
    }
}
