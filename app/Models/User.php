<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'telephone',
        'color',
        'role_id',
        'departement_id'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // lien avec le model Todo dans le cadre de l'utilisateur qui cree une tache

    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }

    // lien avec le model Todo dans le cadre des taches affectees a un ou plusieurs personel

    public function taches()
    {
        return $this->belongsToMany(Todo::class);
    }

    // lien avec le model role 

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // lien avec le model departement

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    // lien avec le model Planning

    public function planings(): HasMany
    {
        return $this->hasMany(Planning::class);
    }
}
