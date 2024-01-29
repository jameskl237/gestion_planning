<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date_debut',
        'date_fin',
        'heure_debut',
        'heure_fin',
        'user_id',
    ];

    // lien avec le model User dans le cadre de l'utilisateur qui cree une tache

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // lien avec le model User dans le cadre des taches affectees a un ou plusieurs personel

    public function taches()
    {
        return $this->belongsToMany(User::class);
    }

    // lien avec le model Planning 

    public function Planning()
    {
        return $this->belongsToMany(Planning::class);
    }

    // lien avec le model Salle 

    public function salle()
    {
        return $this->belongsToMany(Salle::class);
    }
}
