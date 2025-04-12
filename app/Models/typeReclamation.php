<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeReclamation extends Model
{
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function reclamations()
    {
        return $this->hasMany(Reclamation::class, 'type_reclamations_id');
    }

    public function agents()
    {
        return $this->belongsToMany(Agent::class, 'agent_type_reclamation');
    }

}
