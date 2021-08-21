<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Employee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class EmployeeController
{
    #[Route('/average-salary', name: 'averageSalary', methods: 'GET')]
    public function averageSalaryAction(): JsonResponse
    {
        $employees = Employee::get();

        $sum = 0;
        foreach ($employees as $employee) {
            $sum += $employee->salary;
        }

        $average = $sum / $employees->count();

        return new JsonResponse(
            [
                'averageSalary' => $average,
            ]
        );
    }

    #[Route('/bonuses-employees', name: 'bonusesEmployees', methods: 'GET')]
    public function bonusesEmployeesAction(): JsonResponse
    {
        $employees = Employee::get();

        $result = [];
        foreach ($employees as $employee) {
            $bonus = 1;

            if ($employee->rating->rating === 5) {
                $bonus = 10;
            }

            if ($employee->rating->rating === 4) {
                $bonus = 5;
            }

            $result[] = [
                'name' => $employee->name,
                'salary' => $employee->salary,
                'rating' => $employee->rating->rating,
                'email' => $employee->email,
                'total' => $employee->salary + ($employee->salary * $bonus) / 100,
                "bonus ({$bonus}%)" => ($employee->salary * $bonus) / 100,
            ];
        }

        return new JsonResponse(
            [
                'data' => $result
            ]
        );
    }
}
