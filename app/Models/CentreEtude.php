<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentreEtude extends Model
{
    use HasFactory;
    protected $table = 'ced'; // Nom de la table
    protected $fillable = ['nom']; // Colonnes remplissables
}
