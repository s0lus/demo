<?php

declare(strict_types=1);

namespace App\Model;

use App\ValueObject\Bonus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'employees';

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }

    public function calculateBonus(): int
    {
        $bonus = Bonus::fromEmployee($this);

        return ($this->salary * $bonus->value()) / 100;
    }

    public function calculateBonus(): int
    {
        $bonus = Bonus::fromEmployee($this);

        return ($this->salary * $bonus->value()) / 100;
    }
}
