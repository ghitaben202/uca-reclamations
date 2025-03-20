<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'utilisateurs';  // Spécifie la table manuellement si elle n'est pas 'users'

    protected $fillable = [
        'nom',
        'prenom',
        'email_academique',
        'telephone',
        'cne',
        'num_apogee',
        'date_naissance',
        'email_personnel',
        'mot_de_passe',  // Garde le nom correct du champ dans la table
        'ced_id',
        'lab_id',
        'role_id',
        'etablissement_id',
    ];

    protected $hidden = [
        'mot_de_passe',  // Cache le mot de passe pour éviter de l'afficher
    ];

    // Assurer que le mot de passe est correctement haché lors de l'assignation
    public function setMotDePasseAttribute($value)
    {
        $this->attributes['mot_de_passe'] = Hash::make($value);
    }

    // Laravel s'attend à ce que le modèle ait cette méthode pour l'authentification
    public function getAuthIdentifierName()
    {
        return 'email_personnel';  // Ou un autre champ unique pour l'authentification
    }

    public function getAuthPassword()
    {
        return $this->mot_de_passe;  // Utilise le champ 'mot_de_passe'
    }

   
}
