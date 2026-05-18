<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évaluation Enseignants - Accueil</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-900 min-h-screen text-slate-100 flex flex-col justify-between">

    <header class="max-w-6xl w-full mx-auto p-6 flex justify-between items-center">
        <div class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-400">
            EvalProf.
        </div>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-400 hover:text-slate-200 transition">Connexion</a>
            <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl hover:bg-emerald-500/20 transition">Inscription</a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-20 text-center my-auto">
        <span class="px-3 py-1 text-xs font-semibold bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-full tracking-wide">
            🔒 Système 100% Anonyme
        </span>

        <h1 class="text-4xl md:text-6xl font-extrabold text-white mt-6 tracking-tight leading-tight">
            Votre avis compte,<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-400">
                votre identité reste secrète.
            </span>
        </h1>

        <p class="mt-6 text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed">
            Évaluez vos enseignants et vos matières en toute liberté. Grâce à notre protocole de hachage sécurisé, vos retours aident à améliorer les cours sans jamais révéler qui vous êtes.
        </p>

        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-slate-900 font-bold rounded-2xl shadow-lg shadow-emerald-500/20 transition transform hover:-translate-y-0.5">
                Commencer une évaluation
            </a>
            <a href="{{ route('evaluations.dashboard') }}" class="w-full sm:w-auto px-8 py-4 bg-slate-800 hover:bg-slate-700 border border-slate-700 font-semibold rounded-2xl transition text-slate-300">
                Voir les résultats globaux
            </a>
        </div>
    </main>

    <footer class="text-center py-6 border-t border-slate-800/60 text-xs text-slate-500">
        &copy; 2026 EvalProf - Plateforme sécurisée d'évaluation pédagogique.
    </footer>

</body>
</html>