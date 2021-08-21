<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'ratings';

    protected $primaryKey = 'id';

    protected $keyType = 'integer';
}
