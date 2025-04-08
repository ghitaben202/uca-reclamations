<?php

namespace App\Http\Controllers;
use App\Models\Reclamation;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\typeReclamation;
use App\Models\Etablissement;
use App\Models\CentreEtude;


class ReclamationController extends Controller
{
    public function store(Request $request)
    {

    }
    public function show($id)
    {
        // Récupérer la réclamation par son ID
        $reclamation = Reclamation::findOrFail($id);

        // Retourner la vue avec les détails de la réclamation
        return view('reclamations.details', compact('reclamation'));

    }

    public function create()
    {
        $roles = Role::all();
        return view('reclamations.ajouterReclamation', compact('roles'));
    }

    public function getFields(Request $request)
    {
    $role = $request->input('role');
    $roleModel = Role::where('nom', $role)->first();
  
    if (!$roleModel) {
        return response('<p>Rôle non reconnu</p>',400);
    }
    
    $typesReclamation = typeReclamation::where('role_id', $roleModel->id)->get();
    $ced = CentreEtude::all();
    $etablissements = Etablissement::all();

    // Envoie à la vue partielle
    return view('reclamations.partials.champs_role', [
        'role' => $roleModel,
        'typesReclamation' => $typesReclamation,
        'etablissements' => $etablissements,
        'ced' => $ced
    ]);
    }

    
}
