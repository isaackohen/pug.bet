<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-sm text-gray-800 leading-tight">
            Hi, {{ auth()->user()->name }}! 👋
        </h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        @livewire('index')
            </div>
        </div>
    </div>


@livewire('latestgames', ['rowlength' => '10'])
</body>

</x-app-layout>
