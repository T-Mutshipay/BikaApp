<x-app-layout>
    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">Hospitalisation</h1>
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 space-y-2 dark:text-gray-200">
            <p><span class="font-medium">Patient :</span>
                <a class="text-indigo-600 underline" href="{{ route('patients.show', $hospitalisation->patient) }}">
                    {{ $hospitalisation->patient->nom }} {{ $hospitalisation->patient->prenom }}
                </a>
            </p>
            <p><span class="font-medium">Service :</span> {{ $hospitalisation->service?->nom ?? '—' }}</p>
            <p><span class="font-medium">Chambre :</span> {{ $hospitalisation->room->nom }} ({{ $hospitalisation->room->type }})</p>
            <p><span class="font-medium">Admission :</span> {{ $hospitalisation->date_admission->format('Y-m-d') }}</p>
            <p><span class="font-medium">Sortie :</span> {{ $hospitalisation->date_sortie?->format('Y-m-d') ?? 'En cours' }}</p>
        </div>
        <div class="mt-4 flex gap-4">
            <a href="{{ route('hospitalisations.edit', $hospitalisation) }}" class="text-indigo-600 underline">Modifier</a>
            <a href="{{ route('hospitalisations.index', ['service' => $hospitalisation->service_id]) }}" class="text-gray-600 dark:text-gray-300 underline">Retour à la liste</a>
        </div>
    </div>
</x-app-layout>
