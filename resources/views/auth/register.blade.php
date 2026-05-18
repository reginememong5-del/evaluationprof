<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Étudiant</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center text-slate-100">

    <div class="max-w-md w-full bg-slate-800 p-8 rounded-2xl shadow-xl border border-slate-700">
        <h2 class="text-2xl font-bold mb-6 text-center">Créer un compte Étudiant</h2>

        @if($errors->any())
            <div class="mb-4 p-3 bg-rose-500/20 border border-rose-500/40 text-rose-300 rounded-xl text-sm">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf 

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full p-3 bg-slate-950 border border-slate-700 rounded-xl text-white" placeholder="Regine Memong" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full p-3 bg-slate-950 border border-slate-700 rounded-xl text-white" placeholder="exemple@ecole.com" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Mot de passe (8 caractères min.)</label>
                <input type="password" name="password" class="w-full p-3 bg-slate-950 border border-slate-700 rounded-xl text-white" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="w-full p-3 bg-slate-950 border border-slate-700 rounded-xl text-white" required>
            </div>

            <button type="submit" class="w-full p-3 bg-emerald-500 hover:bg-emerald-600 text-slate-900 font-bold rounded-xl transition duration-200 mb-4">
                S'inscrire
            </button>

            <p class="text-xs text-center text-slate-400">
                Déjà inscrit ? <a href="{{ route('login') }}" class="text-emerald-400 hover:underline">Connectez-vous ici</a>
            </p>
        </form>
    </div>

</body>
</html>