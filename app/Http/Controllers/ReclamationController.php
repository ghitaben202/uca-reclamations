<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Reclamation;
use App\Models\Role;
use App\Models\typeReclamation;
use App\Models\Etablissement;
use App\Models\CentreEtude;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;

class ReclamationController extends Controller
{
    public function create()
    {
        $typesReclamation = typeReclamation::all();
        $roles = Role::all();
        return view('reclamations.ajouterReclamation', compact('roles', 'typesReclamation'));
    }
   

    public function store(Request $request)
    {
        $request->merge([
        'role' => strtolower($request->input('role')),
        ]);
        // Validation des champs communs
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'role' => 'required|in:etudiant,doctorant,administratif',
            'type_reclamation_id' => 'required|exists:type_reclamations,id',
        ]);

        // Validation selon le rôle sélectionné
        switch ($request->role) {
            case 'etudiant':
                $request->validate([
                    'nom_etudiant' => 'required|string|max:255',
                    'prenom_etudiant' => 'required|string|max:255',
                    'email_etudiant' => 'required|email',
                    'email_academique' => 'nullable|email|regex:/^[a-zA-Z0-9._%+-]+@uca\.ac\.ma$/',
                    'cne' => 'required|string|max:50',
                    'telephone' => 'required|string|max:20',
                    'etab' => 'required|exists:etablissements,id',
                ]);
                break;

            case 'doctorant':
                $request->validate([
                    'nom_doctorant' => 'required|string|max:255',
                    'prenom_doctorant' => 'required|string|max:255',
                    'email_doctorant' => 'required|email',
                    'email_academique' => 'nullable|email|regex:/^[a-zA-Z0-9._%+-]+@uca\.ac\.ma$/',
                    'telephone' => 'required|string|max:20',
                    'ced' => 'required|exists:ced,id',
                ]);
                break;

            case 'administratif':
                $request->validate([
                    'nom_administratif' => 'required|string|max:255',
                    'prenom_administratif' => 'required|string|max:255',
                    'email_personnel' => 'required|email',
                    'email_academique' => 'nullable|email|regex:/^[a-zA-Z0-9._%+-]+@uca\.ac\.ma$/',
                    'telephone' => 'required|string|max:20',
                    'cat_admini' => 'required|string|max:100',
                    'etablissement' => 'required|exists:etablissements,id',
                ]);
                break;

            default:
                abort(400, 'Rôle non reconnu');
        }
        $utilisateur = Auth::user(); // Utilisateur connecté

        // Mise à jour des champs manquants dans le profil de l'utilisateur
        if ($utilisateur->email_academique === null || $utilisateur->telephone === null) {
            $utilisateur->update([
                'email_academique' => $request->email_academique ?? $utilisateur->email_academique,
                'telephone' => $request->telephone ?? $utilisateur->telephone,
                'cne' => $request->cne ?? $utilisateur->cne,
                'ced_id' => $request->ced ?? $utilisateur->ced_id,
                'etablissement_id' => $request->etablissement ?? $utilisateur->etablissement_id,
            ]);
        }


        // 2. Créer la réclamation
        $reclamation = new Reclamation();
        $reclamation->titre = $request->titre;
        $reclamation->description = $request->description;
        $reclamation->statut = 'en cours';
        $reclamation->utilisateur_id = auth()->id();
        $reclamation->type_reclamations_id = $request->type_reclamation_id;
        $reclamation->save();
        // Retour vers la page du tableau de bord avec un message de succès
        return redirect()->route('reclamations.ajouterReclamation')->with('message' , 'Votre réclamation a été soumise avec succès.');
    }

    public function show($id)
    {
        
        $reclamation = Reclamation::findOrFail($id);
        return view('reclamations.details', compact('reclamation'));

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
