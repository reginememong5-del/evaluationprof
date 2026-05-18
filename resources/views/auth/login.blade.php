<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Étudiant</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center text-slate-100">

    <div class="max-w-md w-full bg-slate-800 p-8 rounded-2xl shadow-xl border border-slate-700">
        <h2 class="text-2xl font-bold mb-6 text-center">Espace Étudiant</h2>

        @if($errors->any())
            <div class="mb-4 p-3 bg-rose-500/20 border border-rose-500/40 text-rose-300 rounded-xl text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf 

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" class="w-full p-3 bg-slate-950 border border-slate-700 rounded-xl text-white" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Mot de passe</label>
                <input type="password" name="password" class="w-full p-3 bg-slate-950 border border-slate-700 rounded-xl text-white" required>
            </div>

            <button type="submit" class="w-full p-3 bg-emerald-500 hover:bg-emerald-600 text-slate-900 font-bold rounded-xl transition duration-200">
                Se connecter
            </button>
        </form>
    </div>

</body>
</html>