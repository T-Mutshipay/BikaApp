<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 dark:text-white">Nouveau patient</h1>
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @include('patients._form', ['action' => route('patients.store'), 'method' => 'POST'])
        </div>
    </div>
</x-app-layout>
