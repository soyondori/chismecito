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

    public static function getAll($with = []): Collection
    {
        return Chisme::with($with)->latest()->get();
    }

    public static function get(string $id, $with = []): Chisme
    {
        return Chisme::with($with)->findOrFail($id);
    }

    public static function getComments(string $id, $with = []): Collection
    {
        return ChismeComment::where('chisme_id', $id)->latest()->with($with)->get();
    }

}
