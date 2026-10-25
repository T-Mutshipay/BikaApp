<x-app-layout>
    <div class="max-w-xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">Nouveau département</h1>
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @include('departements._form', ['action' => route('departements.store'), 'method' => 'POST'])
        </div>
    </div>
</x-app-layout>
