<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Utilisateur;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    // Valider les entrées
    $request->validate([
        'nom' => ['required', 'string', 'max:255'],
        'prenom' => ['required', 'string', 'max:255'],
        'email_personnel' => ['required', 'string', 'email', 'max:255', 'unique:utilisateurs,email_personnel'],
        'mot_de_passe' => ['required', 'string', 'min:8'], // Validation du mot de passe
    ]);

    // Création de l'utilisateur
    $user = Utilisateur::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email_personnel' => $request->email_personnel,
        'mot_de_passe' => Hash::make($request->mot_de_passe), // Hachage du mot de passe pour la sécurité
        'email_academique'=> '',
        'telephone'=> '',
        'cne'=> '',
        'num_apogee' => '',
        'date_naissance' => NULL,
        'ced_id' => NULL,
        'lab_id' => NULL,
        'role_id' => NULL,
        'etablissement_id' => NULL,
    ]);

    // Connexion de l'utilisateur
    Auth::login($user);  // Assurez-vous que $user est de type Utilisateur qui étend Authenticatable

    // Redirection vers la page appropriée après l'inscription
    return redirect()->route('dashboard'); // Changez cela selon vos besoins
}
}
