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
use App\Models\Agent; 

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

        // Vérification du mot de passe
        $user = Utilisateur::where('email_personnel', $credentials['email_personnel'])->first();

        // Si l'utilisateur existe et que le mot de passe est valide
        if ($user && Hash::check($credentials['mot_de_passe'], $user->mot_de_passe)) {
            Auth::login($user);

            $agent = Agent::where('utilisateur_id', $user->id)->first();

            if ($agent) {
                // L'utilisateur est un agent, rediriger vers le dashboard des agents
                return redirect()->route('agent.dashboardAgent');
            }
            
            return redirect()->route('dashboard');
        }

         // Si la connexion échoue
         return back()->withErrors([
            'auth' => 'Email ou mot de passe incorrect.',
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
