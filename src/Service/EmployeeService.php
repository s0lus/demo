<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\EmployeeBonusDto;
use App\Model\Employee;
use App\ValueObject\Bonus;

final class EmployeeService
{
    public function calculateAverageSalary(): int
    {
        $employees = Employee::get();

        $sum = 0;
        foreach ($employees as $employee) {
            $sum += $employee->salary;
        }

        return $sum / $employees->count();
    }

    public function calculateBonuses(): array
    {
        $employees = Employee::orderBy('salary', 'DESC')->get();

        $result = [];
        foreach ($employees as $employee) {
            $calculatedBonus = $employee->calculateBonus();

            $result[] = new EmployeeBonusDto(
                $employee->name,
                $employee->salary,
                $employee->rating->rating,
                $employee->email,
                $employee->salary + $calculatedBonus,
                Bonus::fromEmployee($employee),
                $calculatedBonus
            );
        }

        return $result;
    }
}
