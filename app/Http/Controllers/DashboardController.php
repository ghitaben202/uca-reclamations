<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamation;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    //
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

}



