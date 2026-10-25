<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">Modifier le patient</h1>
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @include('patients._form', [
                'patient' => $patient,
                'action' => route('patients.update', $patient),
                'method' => 'PUT',
            ])
        </div>
    </div>
</x-app-layout>
