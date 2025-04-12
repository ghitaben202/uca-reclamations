<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
