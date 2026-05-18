<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
public function create(Request $request)
{
    $teachers = Teacher::all();
    $subjects = Subject::all();
    
    // On récupère l'ID qui vient du login (et s'il n'y est pas, on met 1 par défaut)
    $studentId = $request->query('student_id', 1);

    return view('evaluations.create', compact('teachers', 'subjects', 'studentId'));
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // On récupère l'ID envoyé secrètement par le formulaire
    $realId = $request->input('student_id', 1);

    // Ton hachage anonyme parfait
    $grainDeSel = "MonProjetSecret2026"; 
    $userIdAnonyme = hash('sha256', $realId . $grainDeSel);

    // Validation
    $request->validate([
        'teacher_id' => 'required|exists:teachers,id',
        'subject_id' => 'required|exists:subjects,id',
        'rating' => 'required|integer|min:1|max:5',
        'commentary' => 'nullable|string|max:500',
    ]);

    // Enregistrement anonyme
    Evaluation::create([
        'user_id'    => $userIdAnonyme,
        'teacher_id' => $request->teacher_id,
        'subject_id' => $request->subject_id,
        'rating'     => $request->rating,
        'commentary' => $request->commentary,
    ]);

    // Redirection avec le message vert de succès !
    return redirect()->route('evaluations.create', [
        'success' => 'Votre évaluation a bien été soumise de manière anonyme !',
        'student_id' => $realId // On garde l'ID au cas où il veut revoter pour un autre prof
    ]);
}

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }

public function dashboard()
{
    // 1. Récupérer tous les professeurs avec leurs évaluations
    $teachers = Teacher::with('evaluations')->get();

    // 2. Préparer les données pour le graphique (Chart.js)
    $chartLabels = [];
    $chartAverages = [];

    foreach ($teachers as $teacher) {
        $chartLabels[] = $teacher->nom;
        // On calcule la moyenne des notes pour ce prof, arrondie à 1 chiffre après la virgule
        $chartAverages[] = round($teacher->evaluations->avg('rating'), 1) ?: 0;
    }

    // 3. Récupérer les 10 derniers commentaires anonymes pour le tableau
    $recentEvaluations = Evaluation::with(['teacher', 'subject'])
        ->latest()
        ->take(10)
        ->get();

    return view('evaluations.dashboard', compact('teachers', 'chartLabels', 'chartAverages', 'recentEvaluations'));
}
}
