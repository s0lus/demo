<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\EmployeeBonusDto;
use App\Entity\Employee;
use App\Repository\EmployeeRepositoryInterface;
use App\ValueObject\Bonus;

final class EmployeeService
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function calculateAverageSalary(): int
    {
        $employees = $this->employeeRepository->findAll();

        $sum = 0;
        foreach ($employees as $employee) {
            $sum += $employee->getSalary();
        }

        return (int) ($sum / \count($employees));
    }

    public function calculateBonuses()
    {
        $employees = $this->employeeRepository->findBy([], ['salary' => 'DESC']);

        $result = [];
        /** @var Employee $employee */
        foreach ($employees as $employee) {
            $calculatedBonus = $employee->calculateBonus();

            $result[] = new EmployeeBonusDto(
                $employee->getName(),
                $employee->getSalary(),
                $employee->getRating()->getRating(),
                $employee->getEmail(),
                $employee->getSalary() + $calculatedBonus,
                Bonus::fromEmployee($employee),
                $calculatedBonus
            );
        }

        return $result;
    }

}
