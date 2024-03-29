<nav x-data="{ open: false }" class="bg-white font-header border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                @livewire('logo-full')
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-8 sm:flex">
                    <x-jet-nav-link href="/" :active="request()->routeIs('home')" :active="request()->routeIs('dashboard')">
                    {{ __('Home') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('slots') }}" :active="request()->routeIs('slots')" :active="request()->routeIs('slots.real')">
                    {{ __('Slots') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('livecasino') }}" :active="request()->routeIs('livecasino')">
                    {{ __('Live Casino') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('poker') }}" :active="request()->routeIs('poker')">
                    {{ __('Poker') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('bonus') }}" :active="request()->routeIs('bonus')">
                    {{ __('Bonus') }}                   
                    </x-jet-nav-link>
                    @auth
                    @if(auth()->user()->freespins > 0)
                    <x-jet-nav-link onclick="$openModal('freespins')" class="cursor-pointer" :active="request()->routeIs('bonus')">
                    {{ __('Free Spins') }}                   
                        <span class="relative inline-block">
                          <svg class="w-4 h-4 text-white fill-current" viewBox="0 0 20 20"><path d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>

                          <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-0.5 text-xs leading-none text-gray-50 transform translate-x-1/2 -translate-y-1/2 bg-primary rounded-full">{{auth()->user()->freespins}}</span>
                        </span>
                    </x-jet-nav-link>
                    @endif
                    @endauth
                </div>
            </div>
            @auth
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <button class="flex text-sm border-2 border-transparent rounded-full hover:outline-none focus:outline-none">
                    <img class="h-6 w-6 rounded-full object-cover mt-2 ml-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    <div wire:poll.4000ms class="mt-3 mr-3 ml-3">

                        <span class="text-primary hover:text-primarysoft">{{auth()->user()->balance()}}$</span>    
                    </div>
                    </button>
                        <div onclick="$openModal('vip')" class="inline-flex items-center bg-white leading-none cursor-pointer">
                              <span id="vip-progress" class="inline-flex px-2 text-blue-400">@livewire('profile.vip-progress')</span> 
                        </div>
                    @else
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                        {{ Auth::user()->name }}
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        </button>
                    </span>
                    @endif
                    </x-slot>
                    <x-slot name="content">
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Your Account') }}
                    </div>
                    <x-jet-dropdown-link onclick="$openModal('wallets')" href="#">
                    {{ __('Wallet') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('bonus') }}">
                    {{ __('Bonus') }}
                    </x-jet-dropdown-link> 
                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Profile') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Settings') }}
                    </x-jet-dropdown-link>
                    <div class="border-t border-gray-100"></div>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-jet-dropdown-link href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                        </x-jet-dropdown-link>
                    </form>
                    </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('Home') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('slots') }}" :active="request()->routeIs('slots')">
            {{ __('Slots') }}
            </x-jet-responsive-nav-link>
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="flex-shrink-0 mr-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>
                @endif
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    <div class="font-semibold text-base text-gray-800">Balance {{ Auth::user()->balance() }}$</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                {{ __('Profile') }}
                </x-jet-responsive-nav-link>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                {{ __('API Tokens') }}
                </x-jet-responsive-nav-link>
                @endif
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>
                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-200"></div>
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>
                <!-- Team Settings -->
                <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                {{ __('Team Settings') }}
                </x-jet-responsive-nav-link>
                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                {{ __('Create New Team') }}
                </x-jet-responsive-nav-link>
                @endcan
                <div class="border-t border-gray-200"></div>
                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                </div>
                @foreach (Auth::user()->allTeams() as $team)
                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                @endforeach
                @endif
            </div>
        </div>
    </div>
    @else
    <div class="flex items-center ml-6">
            <button onclick="$openModal('login')" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
            Login 
            </button>
        <a class="inline-flex rounded-md" href="/register">
            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
            Register
            </button>
        </a>
    </div>
    @endauth
</nav>