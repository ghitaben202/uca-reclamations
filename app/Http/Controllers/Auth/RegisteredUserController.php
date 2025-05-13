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
        try {
            // Valider les entrées
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email_personnel' => 'required|string|email|max:255|unique:utilisateurs,email_personnel',
                'mot_de_passe' => 'required|string|min:8',
                'role_id' => 'required|exists:roles,id',
            ], [
                'nom.required' => 'Le nom est requis',
                'prenom.required' => 'Le prénom est requis',
                'email_personnel.required' => 'L\'email est requis',
                'email_personnel.email' => 'L\'email doit être valide',
                'email_personnel.unique' => 'Cet email est déjà utilisé',
                'mot_de_passe.required' => 'Le mot de passe est requis',
                'mot_de_passe.min' => 'Le mot de passe doit contenir au moins 8 caractères',
                'role_id.required' => 'Le rôle est requis',
                'role_id.exists' => 'Le rôle sélectionné n\'est pas valide',
            ]);

            // Création de l'utilisateur
            $user = new Utilisateur();
            $user->nom = $validated['nom'];
            $user->prenom = $validated['prenom'];
            $user->email_personnel = $validated['email_personnel'];
            $user->mot_de_passe = Hash::make($validated['mot_de_passe']);
            $user->email_academique = '';
            $user->telephone = '';
            $user->cne = '';
            $user->num_apogee = '';
            $user->date_naissance = null;
            $user->ced_id = null;
            $user->lab_id = null;
            $user->role_id = $validated['role_id'];
            $user->etablissement_id = null;
            $user->save();

            // Redirection vers la page de connexion avec un message de succès
            return redirect()->route('login')->with('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'inscription : ' . $e->getMessage());
            return back()->withErrors(['error' => 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.'])->withInput();
        }
    }

    public function dashboard()
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté
        return view('dashboard', compact('user'));
    }

}
