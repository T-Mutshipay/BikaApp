<x-app-layout>
    <div class="container mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold mb-4">Liste des Responsables des Patients</h1>
        <a href="{{ route('patient_responsables.create') }}" class=" text-white px-4 py-2 rounded">
            Ajouter un Responsable
        </a>
        <table class="min-w-full mt-4 border border-gray-300 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-2 text-left">Patient</th>
                    <th class="px-6 py-2 text-left">Médecin Responsable</th>
                    <th class="px-6 py-2 text-left">Rôle</th>
                    <th class="px-6 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patientResponsables as $responsable)
                    <tr class="border-b">
                        <td class="px-6 py-2">{{ $responsable->patient->nom }}</td>
                        <td class="px-6 py-2">{{ $responsable->user->name }}</td>
                        <td class="px-6 py-2">{{ $responsable->role }}</td>
                        <td class="px-6 py-2">
                            <a href="{{ route('patients.show',["patient"=>$responsable->patient_id]) }}" class="text-black flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>
                            @if ( auth()->user()->specialite == 'informatique' || auth()->user()->specialite == 'admin' )
                            <form action="{{ route('patient_responsables.destroy', $responsable->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2">Supprimer</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
