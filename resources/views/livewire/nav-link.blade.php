@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('slots') }}" :active="request()->routeIs('slots')">
                        {{ __('Slots') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('slots') }}" :active="request()->routeIs('sports')">
                        {{ __('Sports') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('slots') }}" :active="request()->routeIs('poker')">
                        {{ __('Poker') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('slots') }}" :active="request()->routeIs('livecasino')">
                        {{ __('Live Casino') }}
                    </x-jet-nav-link>