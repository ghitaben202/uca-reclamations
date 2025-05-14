<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeReclamation;

class Reclamation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'utilisateur_id', 
        'type_reclamation_id', 
        'agent_id',
        'titre', 
        'description', 
        'statut',
        'reponse',
        'date_creation',
        'date_update'
    ];

    protected $dates = [
        'date_creation',
        'date_update',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'date_creation' => 'datetime',
        'date_update' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
    public function typeReclamation()
    {
        return $this->belongsTo(typeReclamation::class, 'type_reclamation_id');

    }
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}
