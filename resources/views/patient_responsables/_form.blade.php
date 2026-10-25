@php $r = $patientResponsable ?? null; @endphp
<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf
    @if (($method ?? 'POST') !== 'POST')
        @method($method)
    @endif
    <div>
        <x-input-label for="patient_id" value="Patient" />
        <x-select-input id="patient_id" name="patient_id" class="mt-1 block w-full" required>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}" @selected((int) old('patient_id', $r?->patient_id) === $patient->id)>{{ $patient->nom }} {{ $patient->prenom }}</option>
            @endforeach
        </x-select-input>
        <x-input-error :messages="$errors->get('patient_id')" class="mt-1" />
    </div>
    <div>
        <x-input-label for="user_id" value="Utilisateur responsable" />
        <x-select-input id="user_id" name="user_id" class="mt-1 block w-full" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected((int) old('user_id', $r?->user_id) === $user->id)>{{ $user->name }}</option>
            @endforeach
        </x-select-input>
        <x-input-error :messages="$errors->get('user_id')" class="mt-1" />
    </div>
    <div>
        <x-input-label for="role" value="Rôle" />
        <x-text-input id="role" name="role" type="text" class="mt-1 block w-full" :value="old('role', $r?->role)" required />
        <x-input-error :messages="$errors->get('role')" class="mt-1" />
    </div>
    <div class="flex items-center gap-4">
        <x-primary-button>Enregistrer</x-primary-button>
        <a href="{{ route('patient_responsables.index') }}" class="text-sm text-gray-600 dark:text-gray-300 underline">Annuler</a>
    </div>
</form>
