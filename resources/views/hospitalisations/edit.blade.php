<x-app-layout>
    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">Modifier l'hospitalisation</h1>
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @include('hospitalisations._form', [
                'hospitalisation' => $hospitalisation,
                'action' => route('hospitalisations.update', $hospitalisation),
                'method' => 'PUT',
            ])
        </div>
    </div>
</x-app-layout>
