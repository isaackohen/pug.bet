@auth
<x-modal wire:model.defer="freespins">
    <div class="container mx-auto px-4 sm:px-8">
    <div class="py-12">
       <div class="inline-flex items-center bg-primarysoft leading-none rounded-full p-2 mb-5 shadow text-grey-700 text-sm ring-4 ring-blue-10 cursor-pointer">
      
      <span  class="inline-flex px-2 text-gray-200">You have &nbsp;<span class="text-white font-semibold">{{auth()->user()->freespins}} &nbsp;</span> free spins.</span>
    </div>


@if(auth()->user()->freespins > 0)
@php
$getGames = DB::table('slotslist')->where('p', '=', 'evoplay')->get();
$freespin_slots = \App\Models\Settings::where('key', 'freespins_slots')->first()->value;
@endphp

<x-card>
    <div class="bg-blue-50 border border-blue-400 text-default px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Holy smokes!</strong>
        <span class="block sm:inline text-sm">You have {{auth()->user()->freespins}} free spins. Pick a slotmachine below to play your free spins, once you pick you cannot change to another slotmachine, so pick wisely.</span>
    </div>


    <div class="flex flex-wrap max-w-7xl mx-auto sm:px-3 lg:px-4">
        @foreach($getGames as $game)
        @if(in_array($game["_id"], explode(',', $freespin_slots)))
        <div data-tilt-scale="1.05" data-tilt-max="10" data-tilt-speed="500" data-tilt-perspective="1000" data-tilt class="xl:w-1/3 lg:w-1/3 md:w-1/3 sm:w-1/3 w-1/2 p-2 my-4 wire:loading.remove">
            @if($game["ext"] === "c2")
            <a @auth href="/slots/freespins/{{$game['_id']}}" @else href="/slots/demo/{{$game['_id']}}" @endauth>
            @else
            <a @auth href="/slots/freespins/{{$game['_id']}}" @else onclick="$openModal('login')" @endauth>
            @endif
                <div class="group cursor-pointer bg-gray-200 rounded-component transition duration-400 ease hover:bg-primary hover:shadow-2xl">
                    <div class="absolute inset-0 z-10 bg-gray-100 rounded-component text-center flex flex-col items-center justify-center opacity-20 hover:opacity-0 bg-opacity-0 duration-400 ease"></div>
                    <img class="big-thumbnail rounded-component" src="https://cdn.apigamble.com/i/long/jpg/{{$game['_id']}}.jpg" alt="">
                </div></a>
            </div>
            @endif
            @endforeach
    </div>
       
    </x-card>
    <div class="mt-5 mb-5"></div>

      @livewire('paydash')
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" />
                <x-button primary label="Support" />
            </div>
        </x-slot>
        </div>
    </div>

    @else
    <x-card>
    You do not have any freespins left to spend.
    </x-card>
    @endif
</x-modal>

@endauth


