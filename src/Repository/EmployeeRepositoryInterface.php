<?php

declare(strict_types=1);

namespace App\Repository;

interface EmployeeRepositoryInterface
{
    public function findAll();

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
}
