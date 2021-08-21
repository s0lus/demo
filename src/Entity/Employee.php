<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EmployeeRepository;
use App\ValueObject\Bonus;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 * @ORM\Table(name="employees")
 */
class Employee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Rating::class, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private Rating $rating;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $email;

    /**
     * @ORM\Column(type="integer")
     */
    private int $salary;

    public function __construct(int $id, string $name, string $email, int $salary, Rating $rating)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->salary = $salary;
        $this->rating = $rating;
    }

    public function getId(): ?int
    {
        return $this->rating->getEmployeeId();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getRating(): Rating
    {
        return $this->rating;
    }

    public function setRating(Rating $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function calculateBonus(): int
    {
        $bonus = Bonus::fromEmployee($this);

        return ($this->salary * $bonus->value()) / 100;
    }
}
