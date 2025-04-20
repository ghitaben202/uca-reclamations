<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AgentProfileController extends Controller
{
    public function index()
    {
        $agent = Auth::guard('agent')->user();
        return view('agent.profile.index', compact('agent'));
    }

    public function update(Request $request)
    {
        $agent = Auth::guard('agent')->user();

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:agents,email,' . $agent->id,
            'current_password' => 'required|current_password:agent',
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $agent->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $agent->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('agent.profile')->with('success', 'Profil mis à jour avec succès');
    }
} 