<x-app-layout>
    <x-flash />

    <div class="container mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold mb-4 dark:text-white">Facturation</h1>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-8">
            <h2 class="text-lg font-semibold mb-4 dark:text-gray-100">Nouvelle facture</h2>
            <form method="POST" action="{{ route('factures.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                @csrf
                <div class="md:col-span-2">
                    <x-input-label for="patient_id" value="Patient" />
                    <x-select-input id="patient_id" name="patient_id" class="mt-1 block w-full" required>
                        <option value="">— Choisir un patient —</option>
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}" @selected((int) old('patient_id') === $patient->id)>{{ $patient->nom }} {{ $patient->prenom }}</option>
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('patient_id')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="montant_total" value="Montant total" />
                    <x-text-input id="montant_total" name="montant_total" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('montant_total')" required />
                    <x-input-error :messages="$errors->get('montant_total')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="statut" value="Statut" />
                    <x-select-input id="statut" name="statut" class="mt-1 block w-full" required>
                        @foreach ($statuts as $statut)
                            <option value="{{ $statut }}" @selected(old('statut', 'En attente') === $statut)>{{ $statut }}</option>
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('statut')" class="mt-1" />
                </div>
                <div class="md:col-span-4">
                    <x-primary-button>Enregistrer la facture</x-primary-button>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">N°</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Patient</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Montant</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Statut</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($facturations as $facturation)
                        <tr class="border-b border-gray-200 dark:border-gray-700 text-sm text-gray-700 dark:text-gray-200">
                            <td class="px-6 py-3">#{{ $facturation->id }}</td>
                            <td class="px-6 py-3">{{ $facturation->patient->nom }} {{ $facturation->patient->prenom }}</td>
                            <td class="px-6 py-3">{{ number_format($facturation->montant_total, 2, ',', ' ') }}</td>
                            <td class="px-6 py-3">{{ $facturation->statut }}</td>
                            <td class="px-6 py-3">{{ $facturation->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <a href="{{ route('factures.show', $facturation) }}" class="text-blue-600 hover:text-blue-800 font-medium">Voir / modifier</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400">Aucune facture enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
