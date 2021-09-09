<x-app-layout>

    <style>
.js-tilt-glare {
border-radius: 18px;
}

#game-card {
  transform-style: preserve-3d;
  transform: perspective(1000px);
}

#thumbnail-text {
  transform: translateZ(10px);
}


</style>

<div class="d-flex justify-content-center pr-7 pl-7">
    {{ $slots->onEachSide(5)->links() }}
</div>

<div class="flex flex-wrap mt-2 max-w-7xl mx-auto sm:px-6 lg:px-8">

    @foreach($slots as $slotslist)
    <div id="game-card" data-tilt data-tilt-scale="1.1" data-tilt-glare data-tilt-max="10" data-tilt-speed="300" data-tilt-perspective="1000" data-tilt class="xl:w-1/7 lg:w-1/6 md:w-1/4 sm:w-1/3 w-1/2 px-3 my-4 pulse">
        <a @auth href="/slots/real/{{$slotslist['_id']}}" @else href="/slots/demo/{{$slotslist['_id']}}" @endauth>
            <div class="group cursor-pointer shadow-md rounded-t-xl">
                <img class="thumbnail rounded-t-xl" src="https://cdn.apigamble.com/i/long/jpg/{{$slotslist['_id']}}.jpg">
                <div class="flex flex-col p-3 font-bold text-gray-700">
                    <p id="thumbnail-text" class="text-sm md:text-xs sm:text-xs">{{$slotslist['n']}}</p>
                    <p class="text-xs font-light text-gray-400 mt-1">
                        {{$slotslist['p']}}
                        <span class="text-xs opacity-0 float-right font-semibold text-blue-300 group-hover:opacity-100">play</span>
                    </p>
                </div>
            </div></a>
        </div>
        @endforeach

    </div>
<div class="d-flex justify-content-center p-5">
        {{ $slots->links() }}
    </div>
</x-app-layout>