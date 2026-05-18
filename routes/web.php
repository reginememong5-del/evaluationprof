<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route pour afficher le formulaire
Route::get('/evaluations/create', [EvaluationController::class, 'create'])->name('evaluations.create');

// Route pour enregistrer les données du formulaire
Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');


// Affichage du formulaire de connexion
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Traitement du formulaire (quand on clique sur Se connecter)
Route::post('/login', [AuthController::class, 'login']);

// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Affichage du formulaire d'inscription
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Traitement de l'inscription (quand on clique sur S'inscrire)
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', [EvaluationController::class, 'dashboard'])->name('evaluations.dashboard');