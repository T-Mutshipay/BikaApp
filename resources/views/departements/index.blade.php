<x-app-layout>
    <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 flex flex-col items-center min-h-screen">

        <!-- Titre -->
        <div class="mt-8">
            <h1 class="font-bold dark:text-white text-slate-900 text-3xl text-center">
                Nos Départements
            </h1>
        </div>
        <div class="flex flex-wrap justify-center gap-6 p-12 m-12 max-w-6xl">
            @foreach ($departements as $departement)
                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl">
                    <a href="{{ route('services.index', ["departement"=>$departement->id]) }}">
                        <h2 class="text-xl font-bold text-center"> {{$departement->nom}} </h2>
                    </a>
                </div>  
            @endforeach
        </div>
    </div>
</x-app-layout>
