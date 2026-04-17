<x-app-layout>
    <div class="container mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold mb-4 dark:text-white ">Ajouter une Chambre</h1>
        <form action="{{ route('rooms.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="nom" class="block font-medium ">Nom</label>
                <input type="text" name="nom" id="nom" class="text-black w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div>
                <label for="type" class="block font-medium">Type</label>
                <input type="text" name="type" id="type" class="text-black w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <div>
                <label for="capacite" class="block font-medium">Capacité</label>
                <input type="number" name="capacite" id="capacite" class=" text-black w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Enregistrer</button>
        </form>
    </div>
</x-app-layout>
