<x-app-layout>
    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">Responsable de patient</h1>
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 space-y-2 dark:text-gray-200">
            <p><span class="font-medium">Patient :</span>
                <a class="text-indigo-600 underline" href="{{ route('patients.show', $patientResponsable->patient) }}">
                    {{ $patientResponsable->patient->nom }} {{ $patientResponsable->patient->prenom }}
                </a>
            </p>
            <p><span class="font-medium">Responsable :</span> {{ $patientResponsable->user->name }}</p>
            <p><span class="font-medium">Rôle :</span> {{ $patientResponsable->role }}</p>
        </div>
        <div class="mt-4 flex gap-4">
            <a href="{{ route('patient_responsables.edit', $patientResponsable) }}" class="text-indigo-600 underline">Modifier</a>
            <a href="{{ route('patient_responsables.index') }}" class="text-gray-600 dark:text-gray-300 underline">Retour à la liste</a>
        </div>
    </div>
</x-app-layout>
