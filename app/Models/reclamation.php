<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reclamation extends Model
{
    use HasFactory;
    protected $fillable = [
        'utilisateur_id', 'type_reclamation_id', 'titre', 'description', 'statut'
    ];
}
