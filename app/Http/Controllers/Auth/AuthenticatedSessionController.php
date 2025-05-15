<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Utilisateur;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email_personnel' => 'required|email|exists:utilisateurs,email_personnel',
            'mot_de_passe' => 'required|min:8',
        ], [
            'email_personnel.required' => "L'adresse e-mail est requise.",
            'email_personnel.email' => "L'adresse e-mail n'est pas valide.",
            'email_personnel.exists' => "Aucun compte trouvé avec cette adresse e-mail.",
            'mot_de_passe.required' => "Le mot de passe est requis.",
            'mot_de_passe.min' => "Le mot de passe doit contenir au moins 8 caractères.",
        ]);

        // Vérification du mot de passe
        $user = Utilisateur::where('email_personnel', $request->email_personnel)->first();

        if ($user && Hash::check($request->mot_de_passe, $user->mot_de_passe)) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        // Si le mot de passe est incorrect
        return back()->withErrors([
            'mot_de_passe' => 'Le mot de passe est incorrect.',
        ])->withInput();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
