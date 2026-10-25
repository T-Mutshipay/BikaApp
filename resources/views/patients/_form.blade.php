@php $p = $patient ?? null; @endphp
<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf
    @if (($method ?? 'POST') !== 'POST')
        @method($method)
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <x-input-label for="nom" value="Nom" />
            <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" :value="old('nom', $p?->nom)" required />
            <x-input-error :messages="$errors->get('nom')" class="mt-1" />
        </div>
        <div>
            <x-input-label for="prenom" value="Prénom" />
            <x-text-input id="prenom" name="prenom" type="text" class="mt-1 block w-full" :value="old('prenom', $p?->prenom)" required />
            <x-input-error :messages="$errors->get('prenom')" class="mt-1" />
        </div>
        <div>
            <x-input-label for="date_naissance" value="Date de naissance" />
            <x-text-input id="date_naissance" name="date_naissance" type="date" class="mt-1 block w-full" :value="old('date_naissance', $p?->date_naissance?->format('Y-m-d'))" required />
            <x-input-error :messages="$errors->get('date_naissance')" class="mt-1" />
        </div>
        <div>
            <x-input-label for="genre" value="Genre" />
            <x-select-input id="genre" name="genre" class="mt-1 block w-full" required>
                @foreach (['Masculin', 'Féminin'] as $genre)
                    <option value="{{ $genre }}" @selected(old('genre', $p?->genre) === $genre)>{{ $genre }}</option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('genre')" class="mt-1" />
        </div>
        <div class="md:col-span-2">
            <x-input-label for="adresse" value="Adresse" />
            <x-text-input id="adresse" name="adresse" type="text" class="mt-1 block w-full" :value="old('adresse', $p?->adresse)" required />
            <x-input-error :messages="$errors->get('adresse')" class="mt-1" />
        </div>
        <div>
            <x-input-label for="telephone" value="Téléphone" />
            <x-text-input id="telephone" name="telephone" type="text" class="mt-1 block w-full" :value="old('telephone', $p?->telephone)" required />
            <x-input-error :messages="$errors->get('telephone')" class="mt-1" />
        </div>
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $p?->email)" required />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Enregistrer</x-primary-button>
        <a href="{{ route('patients.index') }}" class="text-sm text-gray-600 dark:text-gray-300 underline">Annuler</a>
    </div>
</form>
