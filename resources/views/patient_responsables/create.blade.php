<x-app-layout>
    <div class="container mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold mb-4">Ajouter un Responsable</h1>
        <form action="{{ route('patient_responsables.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="patient_id" class="block font-medium">Patient</label>
                <select name="patient_id" id="patient_id" class="w-full border border-gray-300 rounded px-3 py-2">
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="user_id" class="block font-medium">Utilisateur</label>
                <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded px-3 py-2">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="role" class="block font-medium">Rôle</label>
                <input type="text" name="role" id="role" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Enregistrer</button>
        </form>
    </div>
</x-app-layout>
