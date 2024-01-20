<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Chisme extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * Assignable attributes
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'author_id'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
