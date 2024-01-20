<?php

namespace App\Contexts;

use Illuminate\Support\Collection;
use App\Models\Chisme;


class Chismes
{
    public static function create(array $args): Chisme
    {
        return Chisme::create($args);
    }
}
