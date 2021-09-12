<x-app-layout>
<div class="py-12">
    @livewire('index')
</div>
@livewire('latestgames', ['rowlength' => '10'])
</x-app-layout>