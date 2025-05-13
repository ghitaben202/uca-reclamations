<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Reclamation;

class AgentProfileController extends Controller
{
    public function edit()
    {
        $agent = Auth::guard('agent')->user();
        
        // Statistiques des réclamations
        $totalReclamations = Reclamation::where('type_reclamations_id', $agent->type_reclamations_id)->count();
        $enCours = Reclamation::where('type_reclamations_id', $agent->type_reclamations_id)
            ->where('statut', 'en cours')
            ->count();
        $cloturees = Reclamation::where('type_reclamations_id', $agent->type_reclamations_id)
            ->where('statut', 'clôturée')
            ->count();
        $rejetees = Reclamation::where('type_reclamations_id', $agent->type_reclamations_id)
            ->where('statut', 'rejetée')
            ->count();
            
        // Dernières réclamations traitées avec leurs dates
        $recentReclamations = Reclamation::where('type_reclamations_id', $agent->type_reclamations_id)
            ->select('id', 'statut', 'updated_at', 'created_at')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        // Récupérer le type de réclamations de l'agent
        $typeReclamation = $agent->typeReclamation;

        return view('agent.profile.edit', compact(
            'agent',
            'totalReclamations',
            'enCours',
            'cloturees',
            'rejetees',
            'recentReclamations',
            'typeReclamation'
        ));
    }

    public function update(Request $request)
    {
        $agent = Auth::guard('agent')->user();

        // Règles de validation de base
        $rules = [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:agents,username,' . $agent->id,
        ];

        // Si un nouveau mot de passe est fourni
        if ($request->filled('password')) {
            $rules['current_password'] = [
                'required',
                function ($attribute, $value, $fail) use ($agent) {
                    if ($value !== $agent->password) {
                        $fail('Le mot de passe actuel est incorrect.');
                    }
                }
            ];
            
            $rules['password'] = [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                function ($attribute, $value, $fail) use ($agent) {
                    // Vérifier si le nouveau mot de passe est différent de l'ancien
                    if ($value === $agent->password) {
                        $fail('Le nouveau mot de passe doit être différent de l\'ancien.');
                    }
                }
            ];
        } else {
            // Si aucun nouveau mot de passe n'est fourni, le mot de passe actuel n'est pas requis
            $rules['current_password'] = 'nullable';
        }

        $messages = [
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ];

        $request->validate($rules, $messages);

        // Mise à jour des informations de base
        $agent->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'username' => $request->username,
        ]);

        // Mise à jour du mot de passe si fourni
        if ($request->filled('password')) {
            $agent->update([
                'password' => $request->password, // Stockage sans hashing
            ]);
        }

        return redirect()->route('agent.profile')->with('success', 'Profil mis à jour avec succès');
    }
} 