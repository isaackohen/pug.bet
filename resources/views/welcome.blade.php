<x-app-layout>
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('index')
        </div>
    </div>
</div>
@php
$slotslist = DB::table('slotslist')->get();
$featuredslots = \App\Models\Settings::where('key', 'featured_slots')->first()->value;
@endphp
<div class="flex flex-wrap max-w-7xl mx-auto sm:px-3 lg:px-4">
    
    @foreach($slotslist->shuffle() as $game)
    @if(in_array($game["_id"], explode(',', $featuredslots)))
    <div class="xl:w-1/7 lg:w-1/5 md:w-1/5 sm:w-1/3 xs:w-1/2 p-3 w-1/2 my-2 pulse">
        @if($game["ext"] === "c2")
        <a @auth href="/slots/real/{{$game['_id']}}" @else href="/slots/demo/{{$game['_id']}}" @endauth>
        @else
        <a @auth href="/slots/real/{{$game['_id']}}" @else onclick="$openModal('login')" @endauth>
        @endif
            <div class="group cursor-pointer bg-gray-200 rounded-lg transition duration-300 ease hover:bg-primary hover:shadow-xl">
                <div class="absolute inset-0 z-10 bg-gray-100 rounded-t-lg text-center flex flex-col items-center justify-center opacity-20 hover:opacity-0 bg-opacity-0"></div>
                <img class="big-thumbnail rounded-lg" src="https://cdn.apigamble.com/i/long/jpg/{{$game['_id']}}.jpg" alt="">
                <div class="flex flex-col p-3 font-semibold text-black group-hover:text-gray-100">
                    <p class="text-xs md:text-xs sm:text-xs">{{$game['n']}}</p>
                    <p class="text-xs font-light text-gray-400 group-hover:text-gray-300 mt-1">
                        {{$game['p']}}
                        <span class="text-xs opacity-0 float-right font-semibold text-blue-200 group-hover:opacity-100">play</span>
                    </p>
                </div>
            </div></a>
        </div>
    @endif
    @endforeach

    </div>
    @livewire('latestgames', ['rowlength' => '10'])
    </x-app-layout>
