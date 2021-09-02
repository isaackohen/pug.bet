<x-app-layout>


    <div class="py-12 css-transitions-only-after-page-load">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('index')
            </div>
        </div>
    </div>
@livewire('latestgames', ['rowlength' => '10'])

</x-app-layout>
