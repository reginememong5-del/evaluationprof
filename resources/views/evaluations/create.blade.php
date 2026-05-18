<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évaluation des Enseignants</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 min-h-screen text-slate-100 flex items-center justify-center p-4">

    <div class="max-w-xl w-full bg-slate-800/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-slate-700/50">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">
                Évaluation des Professeurs
            </h1>
            <p class="text-sm text-slate-400 mt-2">Votre retour constructif aide à améliorer la qualité pédagogique.</p>
        </div>

    @if(request()->has('success'))
        <div class="mb-6 p-4 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 rounded-xl text-sm">
        {{ request()->query('success') }}
        </div>
    @endif  

        @if($errors->any())
            <div class="mb-6 p-4 bg-rose-500/20 border border-rose-500/40 text-rose-300 rounded-xl text-sm">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('evaluations.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="student_id" value="{{ $studentId }}">

            <div>
                <label for="teacher_id" class="block text-sm font-semibold text-slate-300 mb-2">Enseignant</label>
                <select name="teacher_id" id="teacher_id" required 
                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                    <option value="">-- Choisir un professeur --</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->nom }} {{ $teacher->prenom }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="subject_id" class="block text-sm font-semibold text-slate-300 mb-2">Matière</label>
                <select name="subject_id" id="subject_id" required 
                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                    <option value="">-- Choisir une matière --</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->nom }} ({{ $subject->code }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="rating" class="block text-sm font-semibold text-slate-300 mb-2">Note (Sur 5)</label>
                <select name="rating" id="rating" required 
                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                    <option value="">-- Donner une note --</option>
                    <option value="5">⭐⭐⭐⭐⭐ (Excellent)</option>
                    <option value="4">⭐⭐⭐⭐ (Très Bien)</option>
                    <option value="3">⭐⭐⭐ (Bien)</option>
                    <option value="2">⭐⭐ (Insuffisant)</option>
                    <option value="1">⭐ (Médiocre)</option>
                </select>
            </div>

            <div>
                <label for="commentary" class="block text-sm font-semibold text-slate-300 mb-2">Commentaire anonyme</label>
                <textarea name="commentary" id="commentary" rows="4" placeholder="Votre avis constructif ici..."
                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 placeholder-slate-500 focus:outline-none focus:border-emerald-500 transition resize-none"></textarea>
            </div>

            <button type="submit" 
                class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-slate-900 font-bold py-3.5 px-4 rounded-xl transition shadow-lg shadow-emerald-950/20 active:scale-[0.98]">
                Soumettre l'évaluation anonyme
            </button>

        </form>
    </div>

</body>
</html>