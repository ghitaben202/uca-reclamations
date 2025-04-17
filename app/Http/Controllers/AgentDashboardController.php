<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $agent = Auth::guard('agent')->user();
        
        // Statistiques des réclamations
        $total = Reclamation::where('type_reclamations_id', $agent->type_reclamations_id)->count();
        $enCours = Reclamation::where('type_reclamations_id', $agent->type_reclamations_id)
            ->where('statut', 'en cours')
            ->count();
        $cloturees = Reclamation::where('type_reclamations_id', $agent->type_reclamations_id)
            ->where('statut', 'clôturée')
            ->count();
        $rejetees = Reclamation::where('type_reclamations_id', $agent->type_reclamations_id)
            ->where('statut', 'rejetée')
            ->count();
        
        // Dernières réclamations
        $recentReclamations = Reclamation::where('type_reclamations_id', $agent->type_reclamations_id)
            ->orderBy('date_creation', 'desc')
            ->take(5)
            ->get();

        return view('agent.dashboard', compact(
            'total',
            'enCours',
            'cloturees',
            'rejetees',
            'recentReclamations'
        ));
    }
} 