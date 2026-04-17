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
    <div class="p-6 dark:bg-slate-500 min-h-screen">
        <!-- Bouton pour afficher/masquer le formulaire -->
        <div class="flex justify-end mb-4">
            <button id="toggle-form" 
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full shadow flex items-center">
                <span class="mr-2">Ajouter</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
        </div>

        <!-- Formulaire masqué -->
        <div id="form-container" class="p-6 rounded-lg shadow-lg mb-6 hidden">
            <h2 class="text-lg dark:text-white font-bold mb-4">Ajouter un Patient</h2>
            <form id="patient-form" class="space-y-4" action="{{route('patients.store')}}" method="post">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nom" class="block font-medium dark:text-white">Nom</label>
                        <input type="text" id="nom" name="nom" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label for="prenom" class="block font-medium dark:text-white">Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="date_naissance" class="block font-medium dark:text-white">Date de naissance</label>
                        <input type="date" id="date_naissance" name="date_naissance" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label for="genre" class="block font-medium dark:text-white">Genre</label>
                        <select id="genre" name="genre" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="Masculin">Masculin</option>
                            <option value="Féminin">Féminin</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="adresse" class="block font-medium dark:text-white">Adresse</label>
                    <input type="text" id="adresse" name="adresse" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="telephone" class="block font-medium dark:text-white">Téléphone</label>
                        <input type="text" id="telephone" name="telephone" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label for="email" class="block font-medium dark:text-white">Email</label>
                        <input type="email" id="email" name="email" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Enregistrer</button>
                </div>
            </form>
        </div>

        <!-- Table des données -->
        <div class=" p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <input type="text" id="search" placeholder="Rechercher..." class="w-full rounded-md shadow-sm">
            </div>
            <table class="w-full dark:text-white text-left">
                <thead class="bg-gray-200 dark:bg-gray-800">
                    <tr>
                        <th class="border  px-4 py-2">Nom</th>
                        <th class="border  px-4 py-2">Prénom</th>
                        <th class="border  px-4 py-2">Date de naissance</th>
                        <th class="border  px-4 py-2">Genre</th>
                        <th class="border  px-4 py-2">Adresse</th>
                        <th class="border  px-4 py-2">Téléphone</th>
                        <th class="border  px-4 py-2">Email</th>
                        <th class="border  px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody id="patientTable" class="dark:bg-gray-900">
                    @foreach($patients as $patient)
                    <tr>
                        <td class="  px-4 py-2">{{$patient->nom}}</td>
                        <td class="  px-4 py-2">{{$patient->prenom}}</td>
                        <td class="  px-4 py-2">{{$patient->date_naissance}}</td>
                        <td class="  px-4 py-2">{{$patient->genre}}</td>
                        <td class="  px-4 py-2">{{$patient->adresse}}</td>
                        <td class="  px-4 py-2">{{$patient->telephone}}</td>
                        <td class="  px-4 py-2">{{$patient->email}}</td>
                        <td class=" flex px-6 py-4">
                            <a href="{{route('patients.show',["patient"=>$patient->id])}}" class="text-blue-600 hover:text-blue-800 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                  
                            </a>
                            <button class="text-red-600 hover:text-red-800 font-medium ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('toggle-form').addEventListener('click', function() {
            const formContainer = document.getElementById('form-container');
            formContainer.classList.toggle('hidden');
        });

        const patients = @json($patients);

        function renderPatient(patients){
            const tableBody = document.getElementById('patientTable');
            tableBody.innerHTML = '';
            patients.forEach((patient)=>{
                const row = `
                    <tr>
                        <td class="  px-4 py-2">${patient.nom}</td>
                        <td class="  px-4 py-2">${patient.prenom}</td>
                        <td class="  px-4 py-2">${patient.date_naissance}</td>
                        <td class="  px-4 py-2">${patient.genre}</td>
                        <td class="  px-4 py-2">${patient.adresse}</td>
                        <td class="  px-4 py-2">${patient.telephone}</td>
                        <td class="  px-4 py-2">${patient.email}</td>
                        <td class="  flex px-6 py-4">
                            <button class="text-blue-600 hover:text-blue-800 font-medium">Modifier</button>
                            <button class="text-green-600 hover:text-green-800 font-medium ml-2">Consulter</button>
                            <button class="text-red-600 hover:text-red-800 font-medium ml-2">Supprimer</button>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        };

        //gestion de recherche

        document.getElementById('search').addEventListener('input', function(){
            const searchTerm = this.value.toLowerCase();
            const filteredPatients = patients.filter((patient)=>
                patient.nom.toLowerCase().includes(searchTerm) ||
                patient.prenom.toLowerCase().includes(searchTerm) ||
                patient.date_naissance.toLowerCase().includes(searchTerm) ||
                patient.genre.toLowerCase().includes(searchTerm) ||
                patient.adresse.toLowerCase().includes(searchTerm) ||
                patient.telephone.toLowerCase().includes(searchTerm) ||
                patient.email.toLowerCase().includes(searchTerm)
            );
            renderPatient(filteredPatients);
        });
        
    </script>
</x-app-layout>
