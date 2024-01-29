<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    // lien avec le model Todo 

    public function salle()
    {
        return $this->belongsToMany(Todo::class);
    }
}
