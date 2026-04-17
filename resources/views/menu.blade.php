<x-app-layout>
    <div class="container mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @if(auth()->user()->specialite == 'informatique' || auth()->user()->specialite == 'admin')
            <a href="{{ route('patients.index') }}" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center hover:shadow-xl transition-shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-gray-700 dark:text-gray-200 text-center font-semibold">Gérer les patients</p>
            </a>

            <a href="{{ route('users.index') }}" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center hover:shadow-xl transition-shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M16 11V7a4 4 0 10-8 0v4M5 11h14a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2z" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-gray-700 dark:text-gray-200 text-center font-semibold">Nos Médecins</p>
            </a>

            <a href="{{ route('rooms.index') }}" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center hover:shadow-xl transition-shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M3 7h18M3 12h18M3 17h18" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-gray-700 dark:text-gray-200 text-center font-semibold">Locaux</p>
            </a>

            <a href="{{ route('hospitalisations.index') }}" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center hover:shadow-xl transition-shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-gray-700 dark:text-gray-200 text-center font-semibold">Hospitalisations</p>
            </a>

            <a href="{{ route('patient_responsables.create') }}" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center hover:shadow-xl transition-shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-gray-700 dark:text-gray-200 text-center font-semibold">Attribuer un médecin</p>
            </a>

            <a href="{{ route('departements.index') }}" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center hover:shadow-xl transition-shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M3 10h18M3 14h18M3 18h18" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-gray-700 dark:text-gray-200 text-center font-semibold">Département</p>
            </a>
            <a href="{{ route('factures.index') }}" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center hover:shadow-xl transition-shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-red-500 mb-4" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 2h6l3 3v17a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V5l3-3z"></path>
                    <path d="M9 8h6"></path>
                    <path d="M9 12h6"></path>
                    <path d="M9 16h6"></path>
                  </svg>                  
                <p class="text-black dark:text-gray-200 text-center font-semibold">Facturation</p>
            </a>
        @endif

        @if(auth()->user()->specialite != 'informatique' && auth()->user()->specialite != 'admin')
            <a href="{{ route('patient_responsables.index') }}" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center hover:shadow-xl transition-shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-red-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-gray-700 dark:text-gray-200 text-center font-semibold">Mes patients</p>
            </a>
        @endif
    </div>
</x-app-layout>