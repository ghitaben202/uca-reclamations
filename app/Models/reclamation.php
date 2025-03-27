<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeReclamation;

class Reclamation extends Model
{

    
    use HasFactory;
    protected $fillable = [
        'utilisateur_id', 'type_reclamation_id', 'titre', 'description', 'statut'
    ];


    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    public function typeReclamation()
    {
    return $this->belongsTo(TypeReclamation::class, 'type_reclamation_id');
    }

    
}
