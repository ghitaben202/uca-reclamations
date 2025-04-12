<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Agent;

class AgentController extends Controller
{
    public function dashboard()
    {
         // Vérifie si l'utilisateur est authentifié
        if (!auth()->check()) {
        abort(403, 'Accès réservé aux utilisateurs authentifiés.');
        }
        $user = auth()->user();

        $agent = Agent::where('utilisateur_id', $user->id)->first();

        if (!$agent) {
            abort(403, 'Accès réservé aux agents.');
        }

        $type_reclamations = $agent->typeReclamations;

        $enCours = $type_reclamations->where('statut', 'en cours')->count();
        $cloturees = $type_reclamations->where('statut', 'clôturée')->count();
        $total = $type_reclamations->count();

        return view('agent.dashboardAgent', compact('type_reclamations', 'enCours', 'cloturees', 'total'));
    }

}
