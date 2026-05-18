<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Afficher ta vue personnalisée
    public function showLogin()
    {
        return view('auth.login');
    }

    // Traiter la tentative de connexion
    public function login(Request $request)
    {
        // 1. Validation des champs
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

if (Auth::attempt($credentials)) {
    $request->session()->regenerate();

    // On récupère le vrai ID de l'étudiant qui vient de se connecter
    $studentId = Auth::id();

    // On le redirige vers le formulaire en passant son ID en paramètre secret dans l'URL
    return redirect()->route('evaluations.create', ['student_id' => $studentId]);
}

        // Si ça échoue, on revient en arrière avec une erreur
        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }



// 1. Afficher le formulaire d'inscription
public function showRegister()
{
    return view('auth.register');
}

// 2. Traiter l'inscription
public function register(Request $request)
{
    // Validation des données entrées par l'étudiant
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed', // "confirmed" cherche un champ password_confirmation
    ]);

    // Création de l'utilisateur dans la base de données
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // On hache le mot de passe pour la sécurité
    ]);

    // On connecte automatiquement l'étudiant tout de suite après son inscription
    Auth::login($user);

   // Dans la fonction register(), juste après Auth::login($user);
return redirect()->route('evaluations.create', ['student_id' => $user->id]);
}
}