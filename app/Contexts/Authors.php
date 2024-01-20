<?php

namespace App\Contexts;
use App\Models\AuthorComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class Authors
{
    public static function getAll($with = []): Collection
    {
        return User::with(['chismes'])->get();
    }

    public static function get(string $id, $with = []): User
    {
        return User::with($with)->findOrFail($id);
    }

    public static function comment(array $args): AuthorComment
    {
        return AuthorComment::create($args);
    }
}