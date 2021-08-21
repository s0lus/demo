<?php

namespace App\Tests\Service;

use App\Dto\EmployeeBonusDto;
use App\Entity\Employee;
use App\Entity\Rating;
use App\Service\EmployeeService;
use App\Tests\Fake\InMemoryEmployeeRepository;
use PHPUnit\Framework\TestCase;

class EmployeeServiceTest extends TestCase
{
    public function testAverageSalary(): void
    {
        // Arrange
        $inMemoryRepository = new InMemoryEmployeeRepository(
            [
                new Employee(
                    1,
                    'name',
                    'email@email.com',
                    1000,
                    new Rating(
                        40,
                        4
                    )
                ),
                new Employee(
                    2,
                    'name',
                    'email@email.com',
                    1500,
                    new Rating(
                        50,
                        5
                    )
                ),
                new Employee(
                    3,
                    'name',
                    'email@email.com',
                    2500,
                    new Rating(
                        30,
                        3
                    )
                )
            ]
        );
        $employeeService = new EmployeeService($inMemoryRepository);

        // Act
        $averageSalary = $employeeService->calculateAverageSalary();

        // Assert
        self::assertEquals(1666, $averageSalary);
    }

    public function testBonusesCalculation(): void
    {
        $inMemoryRepository = new InMemoryEmployeeRepository(
            [
                new Employee(
                    1,
                    'name',
                    'email@email.com',
                    1500,
                    new Rating(
                        50,
                        5
                    )
                ),
            ]
        );
        $employeeService = new EmployeeService($inMemoryRepository);

        // Act
        /** @var EmployeeBonusDto[] $bonuses */
        $bonuses = $employeeService->calculateBonuses();

        // Assert
        self::assertEquals(1650, $bonuses[0]->getTotal());
    }
}
