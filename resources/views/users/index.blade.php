<x-app-layout>
    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Liste des Médecins</h2>
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
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Spécialité</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Téléphone</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="doctorTable" class="bg-white dark:bg-gray-900">
                    @foreach ($users as $user)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200"> {{ $user->name }} </td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200"> {{ $user->specialite }} </td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200"> {{ $user->telephone }} </td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200"> {{ $user->email }} </td>
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
    <script>
        const doctors = @json($users);

        function renderDoctors(doctors) {
            const tableBody = document.getElementById("doctorTable");
            tableBody.innerHTML = "";
            doctors.forEach((doctor) => {
                const row = `
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">${doctor.name}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">${doctor.specialite}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">${doctor.telephone}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-200">${doctor.email}</td>
                        <td class="px-6 py-4">
                            <button class="text-blue-600 hover:text-blue-800 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </button>
                            <button class="text-red-600 hover:text-red-800 font-medium ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                            </button>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        // Gestion de la recherche
        document.getElementById("search").addEventListener("input", function () {
            const searchTerm = this.value.toLowerCase();
            const filteredDoctors = doctors.filter((doctor) =>
                doctor.name.toLowerCase().includes(searchTerm) ||
                doctor.specialite.toLowerCase().includes(searchTerm) ||
                doctor.telephone.toLowerCase().includes(searchTerm) ||
                doctor.email.toLowerCase().includes(searchTerm)
            );
            renderDoctors(filteredDoctors);
        });

        // Afficher les médecins au chargement
        renderDoctors(doctors);
    </script>
</x-app-layout>
