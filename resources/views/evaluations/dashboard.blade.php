<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord des Évaluations</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate-900 min-h-screen text-slate-100 p-6 md:p-12">

    <div class="max-w-6xl mx-auto">
        
        <div class="flex justify-between items-center mb-10 border-b border-slate-800 pb-5">
            <div>
                <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-400">
                    Visualisation des Résultats
                </h1>
                <p class="text-slate-400 text-sm mt-1">Statistiques globales et retours anonymes des étudiants.</p>
            </div>
            <a href="{{ route('evaluations.create') }}" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 border border-slate-700 rounded-xl text-sm font-medium transition">
                + Voter à nouveau
            </a>
        </div>

        <div class="bg-slate-800 p-6 rounded-2xl shadow-xl border border-slate-700 mb-10">
            <h2 class="text-xl font-semibold mb-6 text-slate-300">Moyenne générale par Enseignant</h2>
            <div class="h-80 w-full">
                <canvas id="teachersChart"></canvas>
            </div>
        </div>

        <div class="bg-slate-800 p-6 rounded-2xl shadow-xl border border-slate-700">
            <h2 class="text-xl font-semibold mb-6 text-slate-300">Les 10 derniers commentaires (Anonymes)</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-700 text-slate-400 text-sm">
                            <th class="pb-3 font-medium">Enseignant</th>
                            <th class="pb-3 font-medium">Matière</th>
                            <th class="pb-3 font-medium">Note</th>
                            <th class="pb-3 font-medium">Commentaire</th>
                            <th class="pb-3 font-medium">ID Anonyme</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50 text-sm text-slate-300">
                        @forelse($recentEvaluations as $eval)
                            <tr>
                                <td class="py-4 font-semibold text-emerald-400">{{ $eval->teacher->nom }}</td>
                                <td class="py-4">{{ $eval->subject->nom }}</td>
                                <td class="py-4">
                                    <span class="px-2.5 py-1 bg-amber-500/10 border border-amber-500/30 text-amber-400 rounded-lg font-bold">
                                        {{ $eval->rating }} / 5
                                    </span>
                                </td>
                                <td class="py-4 max-w-xs truncate italic text-slate-400" title="{{ $eval->commentary }}">
                                    "{{ $eval->commentary ?? 'Pas de commentaire laissé' }}"
                                </td>
                                <td class="py-4 text-xs font-mono text-slate-500">
                                    {{ substr($eval->user_id, 0, 8) }}...
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-500">Aucune évaluation enregistrée pour le moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
        const ctx = document.getElementById('teachersChart').getContext('2d');
        
        // On récupère proprement les données PHP converties en JSON pour JavaScript
        const labels = {!! json_encode($chartLabels) !!};
        const dataAverages = {!! json_encode($chartAverages) !!};

        new Chart(ctx, {
            type: 'bar', // Un beau graphique en barres
            data: {
                labels: labels,
                datasets: [{
                    label: 'Moyenne / 5',
                    data: dataAverages,
                    backgroundColor: 'rgba(52, 211, 153, 0.2)', // Vert émeraude transparent
                    borderColor: 'rgba(52, 211, 153, 1)',     // Vert émeraude opaque
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false } // Pas besoin de légende pour une seule série
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5, // La note max est 5
                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                        ticks: { color: '#94a3b8' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8' }
                    }
                }
            }
        });
    </script>
</body>
</html>