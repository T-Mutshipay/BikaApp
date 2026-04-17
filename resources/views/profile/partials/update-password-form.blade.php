<section>
    <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('User Information') }}
      </h2>
  
      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('View and update your profile details below.') }}
      </p>
    </header>
  
    @if (auth()->check())
      <form 
        method="post" 
        {{-- action="{{ route('users.update') }}"  --}}
        class="mt-6 space-y-6" 
        id="user-profile-form"
      >
        @csrf
        @method('put')
    
        <!-- Champ : Nom -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ __('Name') }}
          </label>
          <input 
            id="name" 
            name="name" 
            type="text" 
            value="{{ auth()->user()->name }}" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300" 
            disabled
          />
        </div>
    
        <!-- Champ : Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ __('Email') }}
          </label>
          <input 
            id="email" 
            name="email" 
            type="email" 
            value="{{ auth()->user()->email }}" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300" 
            disabled
          />
        </div>
    
        <!-- Champ : Spécialité -->
        <div>
          <label for="specialite" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ __('Specialization') }}
          </label>
          <input 
            id="specialite" 
            name="specialite" 
            type="text" 
            value="{{ auth()->user()->specialite }}" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300" 
            disabled
          />
        </div>
    
        <!-- Champ : Téléphone -->
        <div>
          <label for="telephone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ __('Phone Number') }}
          </label>
          <input 
            id="telephone" 
            name="telephone" 
            type="text" 
            value="{{ auth()->user()->telephone }}" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300" 
            disabled
          />
        </div>
    
        <div class="flex items-center gap-4 hidden" id="save-button-container">
          <button 
            type="submit" 
            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-700 focus:ring focus:ring-blue-300 active:bg-blue-800 disabled:opacity-25 transition"
          >
            {{ __('Save') }}
          </button>
        </div>
      </form>
    
      <div class="mt-4">
        <button 
          onclick="enableEditingForUser()" 
          class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-800 focus:ring focus:ring-gray-300 active:bg-gray-900 transition"
        >
          {{ __('Edit Profile') }}
        </button>
      </div>
    @else
      <p>{{ __('You need to be logged in to view this page.') }}</p>
    @endif
  </section>

  <script>
    function enableEditingForUser() {
      document.querySelectorAll('#user-profile-form input').forEach(input => {
        input.disabled = false;
      });
      document.getElementById('save-button-container').classList.remove('hidden');
    }
  </script>