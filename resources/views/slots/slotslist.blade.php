<x-app-layout>

<div class="flex flex-wrap max-w-6xl mx-auto sm:px-3 lg:px-4">
    @foreach($slots->shuffle() as $game)
    @if($game["ext"] === "c2")
    <a @auth href="/slots/real/{{$game['_id']}}" @else href="/slots/demo/{{$game['_id']}}" @endauth>
        @else
        <a @auth href="/slots/real/{{$game['_id']}}" @else onclick="$openModal('login')" @endauth>
            @endif
            <div onclick="redirect('/game/{{$game['_id']}}')" class="slick_slots_browse_poster justify-center bg-gray-700 pulse group shadow-2xl hover:-top-1">
                <div class="main-thumb opacity-95 group-hover:opacity-10">
                    <div class="long-slick-cover" style="aspect-ratio: auto 445 / 589;">
                        <img class="long-slick-cover" id="slotmachine-thumb" alt="Slotmachine" style="aspect-ratio: auto 445 / 589;" width="100%" height="100%" loading="lazy" src="https://cdn.static.bet/i/long/jpg/{{$game['_id']}}.jpg">
                    </div>
                </div>
                <div class="absolute opacity-0 content-center pt-4 group-hover:opacity-100">
                    <div class="name">
                    <div class="font-bold mt-2 text-white" style="font-size: 10px !important;">{{$game['n']}}</div>
                                        <div class="font-light mt-2 text-white" style="font-size: 9px !important;">by <span class="font-semibold" style="font-size: 9px !important;">{{$game['p']}}</span></div>

                    </div>
                    <div>
                    <div class="py-2 px-2 mt-10 bg-primary text-center text-xs text-white hover:bg-primarysoft rounded-component hover:shadow-2xl">Play</div>
                </div>
                </div>
            </div>
        </a>
        @endforeach

    </div>

    <br>
    <br>
<div class="flex flex-wrap max-w-7xl bg-primary mx-auto py-1 sm:px-6 lg:px-4" style="border-radius: 16px;">

<div class="d-flex justify-content-center p-1">
            {{ $slots->links() }}
        </div>

</div>
    <br>
    <br>
    <br>
    <br>
        </div>

</x-app-layout>