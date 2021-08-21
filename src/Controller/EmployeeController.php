<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\EmployeeRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class EmployeeController
{
    private EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    #[Route('/average-salary', name: 'averageSalary', methods: 'GET')]
    public function averageSalaryAction(): JsonResponse
    {
        $employees = $this->employeeRepository->findAll();

        $sum = 0;
        foreach ($employees as $employee) {
            $sum += $employee->getSalary();
        }

        $average = $sum / \count($employees);

        return new JsonResponse(
            [
                'averageSalary' => $average,
            ]
        );
    }

    #[Route('/bonuses-employees', name: 'bonusesEmployees', methods: 'GET')]
    public function bonusesEmployeesAction(): JsonResponse
    {
        $employees = $this->employeeRepository->findAll();

        $result = [];
        foreach ($employees as $employee) {
            $bonus = 1;

            if ($employee->getRating()->getRating() === 5) {
                $bonus = 10;
            }

            if ($employee->getRating()->getRating() === 4) {
                $bonus = 5;
            }

            $result[] = [
                'name' => $employee->getName(),
                'salary' => $employee->getSalary(),
                'rating' => $employee->getRating()->getRating(),
                'email' => $employee->getEmail(),
                'total' => $employee->getSalary() + ($employee->getSalary() * $bonus) / 100,
                "bonus ({$bonus}%)" => ($employee->getSalary() * $bonus) / 100,
            ];
        }

        return new JsonResponse(
            [
                'data' => $result
            ]
        );
    }
}
