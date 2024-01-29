<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo_salle extends Model
{
    use HasFactory;

    public function salle(): BelongsTo
    {
        return $this->belongsTo(Salle::class);
    }

    public function todo(): BelongsTo
    {
        return $this->belongsTo(Todo::class);
    }
}
