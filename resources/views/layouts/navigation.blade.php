<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('menu') }}" class="flex-shrink-0">
                    <img src="img/CUK.png" alt="logo" class="h-12 w-auto">
                </a>
            </div>

            <!-- Menu Principal -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Dropdown pour Département -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 dark:hover:text-black focus:outline-none transition ease-in-out duration-150">
                            {{ __('Département') }}
                            <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{route('services.index', ['departement' => 1])}}">
                            {{ __('Médecine Interne') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{route('services.index', ['departement' => 2])}}">
                            {{ __('Chirurgie') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{route('services.index', ['departement' => 3])}}">
                            {{ __('Gynécologie-Obstétrique') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{route('services.index', ['departement' => 4])}}">
                            {{ __('Pédiatrie') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                <!-- Dropdown pour les paramètres -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 dark:hover:text-black focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('dashboard')">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>
                        <!-- Déconnexion -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Menu Hamburger pour mobile -->
            <div class="-mr-2 flex sm:hidden">
                <button @click="open = ! open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-gray-500" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg class="hidden h-6 w-6" x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu mobile -->
    <div class="sm:hidden" x-show.transition.in="open" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Lien vers le département -->
            <x-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300">{{ __('Département') }}</button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link href="{{route('services.index', ['departement' => 1])}}">
                        {{ __('Médecine Interne') }}
                    </x-dropdown-link>
                    <x-dropdown-link href="{{route('services.index', ['departement' => 2])}}">
                        {{ __('Chirurgie') }}
                    </x-dropdown-link>
                    <x-dropdown-link href="{{route('services.index', ['departement' => 3])}}">
                        {{ __('Gynécologie-Obstétrique') }}
                    </x-dropdown-link>
                    <x-dropdown-link href="{{route('services.index', ['departement' => 4])}}">
                        {{ __('Pédiatrie') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>

            <!-- Autres liens pour mobile -->
            <x-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <button class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300">{{ Auth::user()->name }}</button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                    <x-dropdown-link :href="route('dashboard')">{{ __('Dashboard') }}</x-dropdown-link>

                    <!-- Déconnexion -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Logout') }}</x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>
