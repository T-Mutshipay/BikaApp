<x-app-layout>
    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">Modifier le département</h1>
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @include('departements._form', [
                'departement' => $departement,
                'action' => route('departements.update', $departement),
                'method' => 'PUT',
            ])
        </div>
    </div>
</x-app-layout>
