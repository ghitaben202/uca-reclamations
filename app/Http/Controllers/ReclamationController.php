<?php

namespace App\Http\Controllers;
use App\Models\Reclamation;
use Illuminate\Http\Request;


class ReclamationController extends Controller
{
    public function show($id)
    {
        // Récupérer la réclamation par son ID
        $reclamation = Reclamation::findOrFail($id);

        // Retourner la vue avec les détails de la réclamation
        return view('reclamations.details', compact('reclamation'));
    
        $reclamation = Reclamation::with('typeReclamation')->findOrFail($id);

    }

    
}
