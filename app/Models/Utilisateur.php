<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Utilisez ce chemin
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable; // Incluez ce trait pour gérer les notifications

    protected $table = 'utilisateurs';  // Spécifiez la table manuellement si elle n'est pas 'users'

    protected $fillable = [
        'nom',
        'prenom',
        'email_academique',
        'telephone',
        'cne',
        'num_apogee',
        'date_naissance',
        'email_personnel',
        'mot_de_passe',
        'ced_id',
        'lab_id',
        'role_id',
        'etablissement_id',
    ];

    protected $hidden = [
        'mot_de_passe',
    ];
}