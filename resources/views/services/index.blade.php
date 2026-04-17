<x-app-layout>
    <div class="max-w-7xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-6 text-center dark:text-white">Services du département : {{$departement->nom}} </h1>

        @if ($services->isEmpty())
            <p class="text-gray-600 dark:text-white text-center">Aucun service trouvé pour ce département.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($services as $service)
                <a href="{{route('hospitalisations.index',["service"=>$service->id])}}" >
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-lg text-center">
                        <p class="font-semibold dark:text-white">{{ $service->nom }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        @endif

        <div class="text-center mt-6">
            <a href="{{ route('departements.index') }}" class="text-blue-500 dark:text-white">Retour aux départements</a>
        </div>
    </div>
</x-app-layout>
