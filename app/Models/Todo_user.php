<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'todo_id'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function todos(): BelongsTo
    {
        return $this->belongsTo(Todo::class);
    }

}
