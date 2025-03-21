<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Utilisateur;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
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
Auth::routes();
// Page Dashboard, protégée par auth et verified
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

Route::middleware(['web'])->group(function () {
    // Page d'accueil
    Route::get('/', function () {
        return view('welcome');
    });
});

// Routes protégées par l'authentification
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/utilisateurs/store', [RegisteredUserController::class, 'store'])->name('utilisateurs.store');


// Routes d'enregistrement
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);  // Envoie les données au contrôleur pour traitement

// Routes de connexion
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// Routes générées automatiquement pour l'authentification
require __DIR__.'/auth.php';


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

