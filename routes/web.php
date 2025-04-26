<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Utilisateur;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReclamationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentification par défaut
Auth::routes();
// Page publique (pas besoin d'être connecté)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth - Login / Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

// Routes protégées par middleware "auth"
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Déconnexion
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Profil utilisateur
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Réclamations
    Route::get('/reclamations', [DashboardController::class, 'showReclamations'])->name('reclamations.index');
    Route::get('/reclamations/data', [ReclamationController::class, 'getData'])->name('reclamations.data');
    Route::get('/reclamation/{id}', [ReclamationController::class, 'show'])->name('reclamations.details');
    Route::get('/reclamations/ajouter', [ReclamationController::class, 'create'])->name('reclamations.ajouterReclamation');
    Route::post('/reclamations/get-fields', [ReclamationController::class, 'getFields'])->name('reclamations.getFields');
    Route::post('/reclamations', [ReclamationController::class, 'store'])->name('reclamations.store');
});



    
    



// Routes générées automatiquement pour l'authentification
require __DIR__.'/auth.php';




