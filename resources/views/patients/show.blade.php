<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Détails du Patient</h1>

        <!-- Informations personnelles -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Informations personnelles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <p><span class="font-medium text-gray-600">Nom :</span> {{ $patient->nom }}</p>
                <p><span class="font-medium text-gray-600">Prénom :</span> {{ $patient->prenom }}</p>
                <p><span class="font-medium text-gray-600">Date de naissance :</span> {{ $patient->date_naissance }}</p>
                <p><span class="font-medium text-gray-600">Genre :</span> {{ $patient->genre }}</p>
                <p><span class="font-medium text-gray-600">Adresse :</span> {{ $patient->adresse }}</p>
                <p><span class="font-medium text-gray-600">Téléphone :</span> {{ $patient->telephone }}</p>
                <p><span class="font-medium text-gray-600">Email :</span> {{ $patient->email }}</p>
            </div>
        </div>

        <!-- Hospitalisations -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Hospitalisations</h2>
            @if($patient->hospitalisations->isNotEmpty())
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Service</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Chambre</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Date d'admission</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Date de sortie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->hospitalisations as $hospitalisation)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $hospitalisation->service_id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $hospitalisation->room_id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $hospitalisation->date_admission }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $hospitalisation->date_sorite }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-600">Aucune hospitalisation enregistrée.</p>
            @endif
        </div>

        <!-- Examens -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Examens</h2>
            @if($patient->examens->isNotEmpty())
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Type</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Responsable</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->examens as $examen)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $examen->type }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $examen->date }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $examen->patient_responsable_id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-600">Aucun examen enregistré.</p>
            @endif
        </div>
    </div>
</x-app-layout>
