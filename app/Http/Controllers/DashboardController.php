<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamation;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    public function index()
{
    
    $userId = Auth::id();
    
    $enCours = Reclamation::where('utilisateur_id', Auth::id())
        ->where('statut', 'en cours')
        ->count();

    // Comptage des réclamations "clôturées"
    $cloturees = Reclamation::where('utilisateur_id', Auth::id())
        ->where('statut', 'clôturée')
        ->count();

    // Comptage total des réclamations
    $total = Reclamation::where('utilisateur_id', Auth::id())->count();
     


    return view('dashboard', compact('enCours', 'cloturees', 'total'));
}


public function showReclamations()
{
    $userId = Auth::id();
    // Récupérer les réclamations de l'utilisateur
    $reclamations = Reclamation::where('utilisateur_id', $userId)->get();

    return view('reclamations.index', compact('reclamations'));
}


public function getData(Request $request)
{
    $query = Reclamation::select(['id', 'titre', 'statut', 'date_creation']);

    return DataTables::of($query)
        ->editColumn('date_creation', function ($reclamation) {
            return $reclamation->date_creation->format('d/m/Y H:i');
        })
        ->addColumn('actions', function ($reclamation) {
            return '<a href="#" class="btn btn-success btn-sm"><i class="fas fa-search"></i></a>
                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
        })
        ->rawColumns(['actions'])
        ->make(true);
}

}



