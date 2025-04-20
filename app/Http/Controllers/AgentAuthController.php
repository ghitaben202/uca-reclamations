<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;

class AgentAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Vérifier si l'agent existe
        $agent = Agent::where('username', $credentials['username'])->first();

        if (!$agent) {
            return back()->withErrors([
                'username' => 'Nom d\'utilisateur incorrect.',
            ])->onlyInput('username');
        }

        // Vérifier le mot de passe sans hashing
        if ($credentials['password'] !== $agent->password) {
            return back()->withErrors([
                'password' => 'Mot de passe incorrect.',
            ])->onlyInput('username');
        }

        // Authentifier l'agent
        Auth::guard('agent')->login($agent, $request->has('remember'));

        $request->session()->regenerate();

        return redirect()->intended(route('agent.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::guard('agent')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('agent.login');
    }
} 