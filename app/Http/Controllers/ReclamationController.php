<?php

namespace App\Http\Controllers;
use App\Models\Reclamation;
use App\Models\TypeReclamation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReclamationController extends Controller
{
    public function create()
    {
        $typesReclamation = TypeReclamation::all();
        return view('reclamations.ajouterReclamation', compact('typesReclamation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'role' => 'required|in:etudiant,enseignant,doctorant'
        ]);

        // Validation des champs selon la catégorie
        if ($request->role === 'etudiant') {
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email_personnel' => 'required|email',
                'cne' => 'required|string|max:255',
                'telephone' => 'required|string|max:255'
            ]);
        } elseif ($request->role === 'enseignant') {
            $request->validate([
                'nom_enseignant' => 'required|string|max:255',
                'prenom_enseignant' => 'required|string|max:255',
                'email_enseignant' => 'required|email',
                'matricule' => 'required|string|max:255'
            ]);
        } elseif ($request->role === 'doctorant') {
            $request->validate([
                'nom_doctorant' => 'required|string|max:255',
                'prenom_doctorant' => 'required|string|max:255',
                'email_doctorant' => 'required|email',
                'cne_doctorant' => 'required|string|max:255'
            ]);
        }

        $reclamation = new Reclamation();
        $reclamation->titre = $request->titre;
        $reclamation->description = $request->description;
        $reclamation->utilisateur_id = Auth::id();
        $reclamation->statut = 'en cours';
        
        // Stockage des informations spécifiques selon la catégorie
        if ($request->role === 'etudiant') {
            $reclamation->nom = $request->nom;
            $reclamation->prenom = $request->prenom;
            $reclamation->email = $request->email_personnel;
            $reclamation->cne = $request->cne;
            $reclamation->telephone = $request->telephone;
        } elseif ($request->role === 'enseignant') {
            $reclamation->nom = $request->nom_enseignant;
            $reclamation->prenom = $request->prenom_enseignant;
            $reclamation->email = $request->email_enseignant;
            $reclamation->matricule = $request->matricule;
        } elseif ($request->role === 'doctorant') {
            $reclamation->nom = $request->nom_doctorant;
            $reclamation->prenom = $request->prenom_doctorant;
            $reclamation->email = $request->email_doctorant;
            $reclamation->cne = $request->cne_doctorant;
        }

        $reclamation->save();

        return redirect()->route('dashboard')->with('success', 'Votre réclamation a été soumise avec succès.');
    }

    public function show($id)
    {
        // Récupérer la réclamation par son ID
        $reclamation = Reclamation::findOrFail($id);

        // Retourner la vue avec les détails de la réclamation
        return view('reclamations.details', compact('reclamation'));
    
        $reclamation = Reclamation::with('typeReclamation')->findOrFail($id);

    }

    
}
