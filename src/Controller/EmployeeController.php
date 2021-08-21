<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\EmployeeService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class EmployeeController
{
    private EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    #[Route('/average-salary', name: 'averageSalary', methods: 'GET')]
    public function averageSalaryAction(): JsonResponse
    {
        return new JsonResponse(
            [
                'averageSalary' => $this->employeeService->calculateAverageSalary(),
            ]
        );
    }

    #[Route('/bonuses-employees', name: 'bonusesEmployees', methods: 'GET')]
    public function bonusesEmployeesAction(): JsonResponse
    {
        return new JsonResponse(
            [
                'data' => $this->employeeService->calculateBonuses()
            ]
        );
    }
}
