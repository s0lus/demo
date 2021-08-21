<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Model\Employee;
use App\Model\Rating;
use App\Service\EmployeeService;
use PHPUnit\Framework\TestCase;

class EmployeeServiceTest extends TestCase
{
    public function testAverageSalary(): void
    {
        // Arrange
        $employeeService = new EmployeeService();

        // Act
        $averageSalary = $employeeService->calculateAverageSalary();

        // Assert
        self::assertEquals(100, $averageSalary);
    }

    public function testBonusesCalculation(): void
    {
        // Arrange
        $employee = new Employee();
        $employee->id = 1;
        $employee->name = 'Name';
        $employee->email = 'email@emai.com';
        $employee->salary = 1000;
        $rating = new Rating();
        $rating->employee_id = 1;
        $rating->rating = 5;

        // Act
        $bonus = $employee->calculateBonus();

        // Assert
        self::assertEquals(1100, $bonus);
    }
}
