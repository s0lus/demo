<?php

declare(strict_types=1);

namespace App\Dto;

use App\ValueObject\Bonus;

final class EmployeeBonusDto implements \JsonSerializable
{
    private string $name;

    private int $salary;

    private int $rating;

    private string $email;

    private int $total;

    private Bonus $bonus;

    private int $calculatedBonus;

    public function __construct(
        string $name,
        int $salary,
        int $rating,
        string $email,
        int $total,
        Bonus $bonus,
        int $calculatedBonus
    ) {
        $this->name = $name;
        $this->salary = $salary;
        $this->rating = $rating;
        $this->email = $email;
        $this->total = $total;
        $this->bonus = $bonus;
        $this->calculatedBonus = $calculatedBonus;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'salary' => $this->salary,
            'rating' => $this->rating,
            'email' => $this->email,
            'total' => $this->total,
            "bonus ({$this->bonus->value()}%)" => $this->calculatedBonus
        ];
    }
}
