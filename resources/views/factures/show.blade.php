<x-app-layout>
    <x-flash />

    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">Facture #{{ $facturation->id }}</h1>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6 space-y-2 dark:text-gray-200">
            <p><span class="font-medium">Patient :</span>
                <a class="text-indigo-600 underline" href="{{ route('patients.show', $facturation->patient) }}">
                    {{ $facturation->patient->nom }} {{ $facturation->patient->prenom }}
                </a>
            </p>
            <p><span class="font-medium">Créée le :</span> {{ $facturation->created_at->format('Y-m-d') }}</p>
            @if ($facturation->hospitalisation)
                <p><span class="font-medium">Hospitalisation :</span>
                    <a class="text-indigo-600 underline" href="{{ route('hospitalisations.show', $facturation->hospitalisation) }}">#{{ $facturation->hospitalisation->id }}</a>
                </p>
            @endif
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4 dark:text-gray-100">Modifier</h2>
            <form method="POST" action="{{ route('factures.update', $facturation) }}" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="patient_id" value="{{ $facturation->patient_id }}">
                <div>
                    <x-input-label for="montant_total" value="Montant total" />
                    <x-text-input id="montant_total" name="montant_total" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('montant_total', $facturation->montant_total)" required />
                    <x-input-error :messages="$errors->get('montant_total')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="statut" value="Statut" />
                    <x-select-input id="statut" name="statut" class="mt-1 block w-full" required>
                        @foreach ($statuts as $statut)
                            <option value="{{ $statut }}" @selected(old('statut', $facturation->statut) === $statut)>{{ $statut }}</option>
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('statut')" class="mt-1" />
                </div>
                <div class="flex items-center gap-4">
                    <x-primary-button>Enregistrer</x-primary-button>
                    <a href="{{ route('factures.index') }}" class="text-sm text-gray-600 dark:text-gray-300 underline">Retour à la liste</a>
                </div>
            </form>

            <form method="POST" action="{{ route('factures.destroy', $facturation) }}" class="mt-6"
                  onsubmit="return confirm('Supprimer cette facture ?');">
                @csrf
                @method('DELETE')
                <x-danger-button>Supprimer la facture</x-danger-button>
            </form>
        </div>
    </div>
</x-app-layout>
