<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 dark:bg-gray-800">
        @csrf
        <div class="mb-1">
            <x-input-label for="name" :value="__('Nom')" class="text-lg font-semibold" />
            <x-text-input id="name" 
                class="block mt-1 w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name" 
                placeholder="Ex : Dr. John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
        </div>

        <!-- Téléphone -->
        <div class="mb-4">
            <x-input-label for="telephone" :value="__('Téléphone')" class="text-lg font-semibold" />
            <x-text-input id="telephone" 
                class="block mt-1 w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                type="text" 
                name="telephone" 
                :value="old('telephone')" 
                required 
                autocomplete="telephone" 
                placeholder="Ex : +243 999 888 777" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2 text-red-600" />
        </div>

        <div class="mb-4">
            <x-input-label for="specialite" :value="__('Spécialité')" class="text-lg font-semibold" />
            <select id="specialite" 
                name="specialite" 
                class="block mt-1 w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required>
                <option value="" disabled selected>Choisissez une spécialité</option>
                <option value="Cardiologie">Cardiologie</option>
                <option value="Pédiatrie">Pédiatrie</option>
                <option value="Gynécologie">Gynécologie</option>
                <option value="Chirurgie">Chirurgie</option>
                <option value="ORL">ORL</option>
            </select>
            <x-input-error :messages="$errors->get('specialite')" class="mt-2 text-red-600" />
        </div>

        <div class="mb-4">
            <x-input-label for="email" :value="__('Adresse Email')" class="text-lg font-semibold" />
            <x-text-input id="email" 
                class="block mt-1 w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autocomplete="username" 
                placeholder="Ex : exemple@cuk.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <div class="mb-4">
            <x-input-label for="password" :value="__('Mot de Passe')" class="text-lg font-semibold" />
            <x-text-input id="password" 
                class="block mt-1 w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                type="password" 
                name="password" 
                required 
                autocomplete="new-password" 
                placeholder="********" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>
        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirmation du Mot de Passe')" class="text-lg font-semibold" />
            <x-text-input id="password_confirmation" 
                class="block mt-1 w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                type="password" 
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
                placeholder="********" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
        </div>

        <!-- Bouton d'Enregistrement -->
        <div class="flex items-center justify-between mt-6">
            <a class="inline-block align-baseline font-bold text-sm text-indigo-600 hover:text-indigo-800" href="{{ route('login') }}">
                {{ __('Déjà inscrit ?') }}
            </a>

            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ __('Enregistrer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
