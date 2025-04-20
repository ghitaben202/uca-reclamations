<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


use App\Models\Utilisateur;
use App\Models\typeReclamation;

class Agent extends Model
{
    use HasFactory;

    protected $table = 'agents';

    public function user()
    {
        return $this->belongsTo(Utilisateur::class); // si 'user_id' est la FK
    }
    public function typeReclamations()
    {
        return $this->belongsToMany(TypeReclamation::class, 'agent_type_reclamation');
    }
}

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class Agent extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'username',
        'password',
        'type_reclamations_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function typeReclamation()
    {
        return $this->belongsTo(TypeReclamation::class, 'type_reclamations_id');
    }

    public function reclamations()
    {
        return $this->hasMany(Reclamation::class);
    }
} 

