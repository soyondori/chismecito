<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Chisme;


class ChismeComment extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * Assignable attributes
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'chisme_id',
        'author_id'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function chisme(): BelongsTo
    {
        return $this->belongsTo(Chisme::class);
    }
}
