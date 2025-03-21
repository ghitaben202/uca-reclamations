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
    dd(Auth::user());
    $userId = Auth::id();

    // Comptage des réclamations "en cours"
    $enCours = Reclamation::where('utilisateur_id', $userId)
        ->where('statut', 'en cours')
        ->count();

    // Comptage des réclamations "clôturées"
    $cloturees = Reclamation::where('utilisateur_id', $userId)
        ->where('statut', 'clôturée')
        ->count();

    // Comptage total des réclamations
    $total = Reclamation::where('utilisateur_id', $userId)->count();


    return view('dashboard', compact('enCours', 'cloturees', 'total'));
}

}



