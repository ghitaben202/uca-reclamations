<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentReclamationController extends Controller
{
    public function index(Request $request)
    {
        $agent = Auth::guard('agent')->user();
        
        // Récupérer les réclamations du type de l'agent
        $query = Reclamation::where('type_reclamations_id', $agent->type_reclamations_id);

        // Appliquer le filtre de statut si spécifié
        if ($request->has('statut') && $request->statut !== 'all') {
            $query->where('statut', $request->statut);
        }

        $reclamations = $query->orderBy('date_creation', 'desc')->get();

        return view('agent.reclamations.index', compact('reclamations'));
    }

    public function show(Reclamation $reclamation)
    {
        // Vérifier que la réclamation appartient au type de l'agent
        $agent = Auth::guard('agent')->user();
        if ($reclamation->type_reclamations_id !== $agent->type_reclamations_id) {
            abort(403, 'Accès non autorisé à cette réclamation.');
        }

        return view('agent.reclamations.show', compact('reclamation'));
    }

    public function updateStatus(Request $request, Reclamation $reclamation)
    {
        $this->authorize('update', $reclamation);
        
        $request->validate([
            'statut' => 'required|in:en cours,clôturée,rejetée'
        ]);

        $reclamation->update([
            'statut' => $request->statut
        ]);

        return redirect()->back()->with('success', 'Statut de la réclamation mis à jour avec succès');
    }

    public function reponse(Request $request, Reclamation $reclamation)
    {
        // Vérifier que la réclamation appartient au type de l'agent
        $agent = Auth::guard('agent')->user();
        if ($reclamation->type_reclamations_id !== $agent->type_reclamations_id) {
            abort(403, 'Accès non autorisé à cette réclamation.');
        }

        // Vérifier que la réclamation est en cours
        if ($reclamation->statut !== 'en cours') {
            return redirect()->back()->with('error', 'Cette réclamation ne peut plus être modifiée.');
        }

        $request->validate([
            'reponse' => 'required|string|min:10',
            'statut' => 'required|in:clôturée,rejetée'
        ]);

        try {
            $reclamation->reponse = $request->reponse;
            $reclamation->statut = $request->statut;
            $reclamation->date_update = now();
            $reclamation->save();

            return redirect()->back()->with('success', 'Réponse envoyée et statut mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement de la réponse.');
        }
    }
} 