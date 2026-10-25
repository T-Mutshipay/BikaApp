<x-app-layout>
    <x-flash />

    <div class="container mx-auto py-6 px-4">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Hospitalisations{{ $service ? ' : '.$service->nom : '' }}
            </h2>
            <div class="flex items-center gap-3">
                <input
                    type="text"
                    id="search"
                    placeholder="Rechercher..."
                    class="border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                />
                <a href="{{ route('hospitalisations.create', array_filter(['service' => $service?->id])) }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded-md whitespace-nowrap">
                    Nouvelle hospitalisation
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Prénom</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Genre</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Chambre</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Admission</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Sortie</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="hospitalisationTable" class="bg-white dark:bg-gray-900">
                    @forelse ($hospitalisations as $hospitalisation)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $hospitalisation->patient->nom }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $hospitalisation->patient->prenom }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $hospitalisation->patient->genre }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $hospitalisation->room->nom }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $hospitalisation->room->type }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $hospitalisation->date_admission->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">{{ $hospitalisation->date_sortie?->format('Y-m-d') ?? 'En cours' }}</td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap">
                                <a href="{{ route('hospitalisations.show', $hospitalisation) }}" class="text-gray-600 dark:text-gray-300 hover:underline">Voir</a>
                                <a href="{{ route('hospitalisations.edit', $hospitalisation) }}" class="text-blue-600 hover:text-blue-800 font-medium ml-2">Modifier</a>
                                <form action="{{ route('hospitalisations.destroy', $hospitalisation) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Supprimer cette hospitalisation ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium ml-2">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400">Aucune hospitalisation enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function () {
            const term = this.value.toLowerCase();
            document.querySelectorAll('#hospitalisationTable tr').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
            });
        });
    </script>
</x-app-layout>
