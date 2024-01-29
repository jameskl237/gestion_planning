<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Planning extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id'

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function todo()
    {
        return $this->belongsToMany(Todo::class);
    }
}
