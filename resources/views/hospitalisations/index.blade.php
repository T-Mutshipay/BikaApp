<x-app-layout>
    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-between items-center mb-4">
            @foreach ($hospitalisations as $item)
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Liste des hospitalisations : {{$item->service->nom}} </h2>
            @endforeach
            <input 
                type="text" 
                id="search" 
                placeholder="Rechercher..." 
                class="border border-gray-300 dark:border-gray-700 rounded-md px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Prenom</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Genre</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">nom du local</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">date_admission</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="doctorTable" class="bg-white dark:bg-gray-900">
                    @foreach ($hospitalisations as $hospitalise)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200"> {{ $hospitalise->patient->nom}} </td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200"> {{ $hospitalise->patient->prenom}} </td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200"> {{ $hospitalise->patient->genre}} </td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200"> {{ $hospitalise->room->nom}} </td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200"> {{ $hospitalise->room->type}} </td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200"> {{ $hospitalise->date_admission}} </td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-800 font-medium">Modifier</button>
                                <button class="text-red-600 hover:text-red-800 font-medium ml-2">Supprimer</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
