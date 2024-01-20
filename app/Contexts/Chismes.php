<?php

namespace App\Contexts;

use Illuminate\Support\Collection;
use App\Models\Chisme;
use App\Models\ChismeComment;


class Chismes
{
    public static function create(array $args): Chisme
    {
        return Chisme::create($args);
    }

    public static function comment(array $args): ChismeComment
    {
        return ChismeComment::create($args);
    }

    public static function getAll(): Collection
    {
        return Chisme::all();
    }

    public static function get(string $id): Chisme
    {
        return Chisme::findOrFail($id);
    }

}
