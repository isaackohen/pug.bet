    <x-app-layout>
    <!-- Slots Container -->
    <div class="flex flex-wrap mt-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <style>
        .thumbnail {
        min-height: 200px; max-height: 200px;aspect-ratio: auto 425/589; width: 100%; height: 100%; -o-object-fit: cover; object-fit: cover;
        }
        .feather-icon {
        height: 10px; width: 10px;
        display: inline-flex;
        align-self: center;
        }
        .feather-icon svg {
        height:1em;
        width:1em;
        }
        .feather-icon.feather-baseline svg {
        top: .125em;
        position: relative;
        }
        </style>
        @php
       // auth()->user()->assignRole('writer');;
                auth()->user()->add(5.1124221, 'usd', 'no reason');

        @endphp
        <!-- Not sure if to keep the overlay, that change color of the slotmachine thumbnail div as might be heavy for slow pc's, have to test (showing here to not iterate and put this message above each slot) !-->
        @foreach($slots as $slotslist)
        <div class="xl:w-1/7 lg:w-1/6 md:w-1/5 sm:w-1/4 w-1/2 px-3 my-4">
                <a @auth href="/slots/real/{{$slotslist['_id']}}" @else href="/slots/demo/{{$slotslist['_id']}}" @endauth>
                <div class="group cursor-pointer shadow-md rounded-t-xl transition duration-400 ease transform translate-x-4 translate-y-4">
                    <div class="absolute inset-0 z-10 bg-blue-300 rounded-t-xl text-center flex flex-col items-center justify-center opacity-0 hover:opacity-50 bg-opacity-50 duration-300 ease"></div>
                    <img wire:loading.class="bg-gray" class="thumbnail rounded-t-xl group-hover:shadow-inner group-hover:shadow-xlr" src="https://cdn.apigamble.com/i/long/jpg/{{$slotslist['_id']}}.jpg?width=200" alt="">
                    <div class="flex flex-col p-4 font-bold text-gray-700 group-hover:ring-3 group-hover:ring-blue-20">
                        <p class="text-sm">{{$slotslist['n']}}</p>
                        <p class="text-xs font-light text-gray-400 mt-1">
                            <i class="feather-icon group-hover:text-blue-300" class="opacity-0 group-hover:opacity-100" data-feather="play-circle"></i> {{$slotslist['p']}}
                            <span class="text-xs opacity-0 float-right font-semibold text-blue-300 group-hover:opacity-100">play</span>
                        </p>
                    </div>
                </div></a>
            </div>
            @endforeach
        </div>

                                @livewire('latestgames')

    </x-app-layout>