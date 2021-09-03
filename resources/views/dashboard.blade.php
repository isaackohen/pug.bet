<x-app-layout>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="overflow-hidden">
                                @livewire('index-header')

                @livewire('index')
            </div>
        </div>
    </div>

        <div class="w-40 h-40 absolute bg-purple-300 rounded-full top-0 right-12 hidden md:block"></div>
        <div
            class="w-20 h-40 absolute bg-purple-300 rounded-full bottom-20 left-10 transform rotate-45 hidden md:block">
        </div>
@livewire('latestgames', ['rowlength' => '10'])

</x-app-layout>
