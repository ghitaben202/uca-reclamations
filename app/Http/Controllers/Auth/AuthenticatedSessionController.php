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
        // Validation des informations de connexion
        $credentials = $request->only('email_personnel', 'mot_de_passe');

        //if (Auth::attempt($credentials)) {
            // Connexion réussie
            //return redirect()->route('dashboard');
        //}
        // Vérification du mot de passe
        $user = Utilisateur::where('email_personnel', $credentials['email_personnel'])->first();
        // Vérification du mot de passe
    if ($user && Hash::check($credentials['mot_de_passe'], $user->mot_de_passe)) {
        // Connexion réussie
        Auth::login($user);
        return redirect()->route('dashboard');
    }

         // Si la connexion échoue
         return back()->withErrors([
            'email_personnel' => 'Les informations de connexion sont incorrectes.',
        ]);
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
