@php $h = $hospitalisation ?? null; @endphp
<form method="POST" action="{{ $action }}" class="space-y-4">
    @csrf
    @if (($method ?? 'POST') !== 'POST')
        @method($method)
    @endif

    <div>
        <x-input-label for="patient_id" value="Patient" />
        <x-select-input id="patient_id" name="patient_id" class="mt-1 block w-full" required>
            <option value="">— Choisir un patient —</option>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}" @selected((int) old('patient_id', $h?->patient_id) === $patient->id)>{{ $patient->nom }} {{ $patient->prenom }}</option>
            @endforeach
        </x-select-input>
        <x-input-error :messages="$errors->get('patient_id')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="service_id" value="Service" />
        <x-select-input id="service_id" name="service_id" class="mt-1 block w-full" required>
            <option value="">— Choisir un service —</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}" @selected((int) old('service_id', $h?->service_id ?? ($serviceId ?? null)) === $service->id)>{{ $service->nom }}</option>
            @endforeach
        </x-select-input>
        <x-input-error :messages="$errors->get('service_id')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="room_id" value="Chambre" />
        <x-select-input id="room_id" name="room_id" class="mt-1 block w-full" required>
            <option value="">— Choisir une chambre —</option>
            @foreach ($rooms as $room)
                <option value="{{ $room->id }}" @selected((int) old('room_id', $h?->room_id) === $room->id)>{{ $room->nom }} ({{ $room->type }}, {{ $room->capacite }} lit(s))</option>
            @endforeach
        </x-select-input>
        <x-input-error :messages="$errors->get('room_id')" class="mt-1" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <x-input-label for="date_admission" value="Date d'admission" />
            <x-text-input id="date_admission" name="date_admission" type="date" class="mt-1 block w-full" :value="old('date_admission', $h?->date_admission?->format('Y-m-d') ?? now()->toDateString())" required />
            <x-input-error :messages="$errors->get('date_admission')" class="mt-1" />
        </div>
        <div>
            <x-input-label for="date_sortie" value="Date de sortie (optionnelle)" />
            <x-text-input id="date_sortie" name="date_sortie" type="date" class="mt-1 block w-full" :value="old('date_sortie', $h?->date_sortie?->format('Y-m-d'))" />
            <x-input-error :messages="$errors->get('date_sortie')" class="mt-1" />
        </div>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Enregistrer</x-primary-button>
        <a href="{{ route('hospitalisations.index', array_filter(['service' => $h?->service_id ?? ($serviceId ?? null)])) }}" class="text-sm text-gray-600 dark:text-gray-300 underline">Annuler</a>
    </div>
</form>
