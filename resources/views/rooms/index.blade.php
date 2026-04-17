<x-app-layout>
    <div class="max-w-md mx-auto my-4">
        <!-- Message de succès -->
        @if (session('success'))
            <div
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                role="alert"
            >
                <strong class="font-bold">Succès !</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span
                    class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                    onclick="this.parentElement.style.display='none';"
                >
                    <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.935 2.935a1 1 0 01-1.414-1.414L8.586 10 5.651 7.065a1 1 0 011.414-1.414L10 8.586l2.935-2.935a1 1 0 011.414 1.414L11.414 10l2.935 2.935a1 1 0 010 1.414z"/>
                    </svg>
                </span>
            </div>
        @endif
    
        <!-- Message d'erreur -->
        @if (session('error'))
            <div
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                role="alert"
            >
                <strong class="font-bold">Erreur !</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span
                    class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                    onclick="this.parentElement.style.display='none';"
                >
                    <svg class="fill-current h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.935 2.935a1 1 0 01-1.414-1.414L8.586 10 5.651 7.065a1 1 0 011.414-1.414L10 8.586l2.935-2.935a1 1 0 011.414 1.414L11.414 10l2.935 2.935a1 1 0 010 1.414z"/>
                    </svg>
                </span>
            </div>
        @endif
    </div>
    
    <div class="container mx-auto py-6 px-4 dark:bg-slate-600">
        <h1 class="text-2xl font-bold mb-4">Liste des Chambres</h1>
        <a href="{{ route('rooms.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">
            Ajouter une Chambre
        </a>
        <table class="min-w-full mt-4 border border-gray-300 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-2 text-left">Nom</th>
                    <th class="px-6 py-2 text-left">Type</th>
                    <th class="px-6 py-2 text-left">Capacité</th>
                    <th class="px-6 py-2 text-left">Disponibilité</th>
                    <th class="px-6 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr class="border-b">
                        <td class="px-6 py-2">{{ $room->nom }}</td>
                        <td class="px-6 py-2">{{ $room->type }}</td>
                        <td class="px-6 py-2">{{ $room->capacite }}</td>
                        <td class="px-6 py-2">
                            {{ $room->disponibilite ? 'Disponible' : 'Occupée' }}
                        </td>
                        <td class="px-6 py-2">
                            <a href="{{ route('rooms.edit', $room->id) }}" class="text-indigo-600">Modifier</a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
