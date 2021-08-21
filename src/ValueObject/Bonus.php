<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Entity\Employee;

final class Bonus
{
    private int $bonus;

    private function __construct(int $bonus)
    {
        $this->bonus = $bonus;
    }

    public static function fromEmployee(Employee $employee): self
    {
        if ($employee->getRating()->getRating() === 5) {
            return new self(10);
        }

        if ($employee->getRating()->getRating() === 4) {
            return new self(5);
        }

        return new self(1);
    }

    public function value(): int
    {
        return $this->bonus;
    }
}
