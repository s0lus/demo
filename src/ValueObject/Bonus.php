<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Model\Employee;

final class Bonus
{
    private int $bonus;

    private function __construct(int $bonus)
    {
        $this->bonus = $bonus;
    }

    public static function fromEmployee(Employee $employee): self
    {
        if ($employee->rating->rating === 5) {
            return new self(10);
        }

        if ($employee->rating->rating === 4) {
            return new self(5);
        }

        return new self(1);
    }

    public function value(): int
    {
        return $this->bonus;
    }
}
