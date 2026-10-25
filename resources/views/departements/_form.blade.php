<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf
    @if (($method ?? 'POST') !== 'POST')
        @method($method)
    @endif
    <div>
        <x-input-label for="nom" value="Nom du département" />
        <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" :value="old('nom', $departement->nom ?? '')" required />
        <x-input-error :messages="$errors->get('nom')" class="mt-1" />
    </div>
    <div class="flex items-center gap-4">
        <x-primary-button>Enregistrer</x-primary-button>
        <a href="{{ route('departements.index') }}" class="text-sm text-gray-600 dark:text-gray-300 underline">Annuler</a>
    </div>
</form>
