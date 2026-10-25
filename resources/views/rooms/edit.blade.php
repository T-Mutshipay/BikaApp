<x-app-layout>
    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">Modifier la chambre</h1>
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <form method="POST" action="{{ route('rooms.update', $room) }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label for="nom" value="Nom" />
                    <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" :value="old('nom', $room->nom)" required />
                    <x-input-error :messages="$errors->get('nom')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="type" value="Type" />
                    <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" :value="old('type', $room->type)" required />
                    <x-input-error :messages="$errors->get('type')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="capacite" value="Capacité (nombre de lits)" />
                    <x-text-input id="capacite" name="capacite" type="number" min="1" max="100" class="mt-1 block w-full" :value="old('capacite', $room->capacite)" required />
                    <x-input-error :messages="$errors->get('capacite')" class="mt-1" />
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    La disponibilité est calculée automatiquement à partir des patients hospitalisés.
                </p>
                <div class="flex items-center gap-4">
                    <x-primary-button>Enregistrer</x-primary-button>
                    <a href="{{ route('rooms.index') }}" class="text-sm text-gray-600 dark:text-gray-300 underline">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
