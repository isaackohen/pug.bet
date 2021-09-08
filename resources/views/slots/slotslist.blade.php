    <x-app-layout><div class="d-flex justify-content-center">
{{ $slots->onEachSide(5)->links() }}
</div>
<div class="flex flex-wrap mt-2 max-w-7xl mx-auto sm:px-6 lg:px-8">

    @foreach($slots as $slotslist)
    <div data-tilt-scale="1.1" data-tilt-max="10" data-tilt-speed="300" data-tilt-perspective="1000" data-tilt class="xl:w-1/7 lg:w-1/6 md:w-1/4 sm:w-1/3 w-1/2 px-3 my-4 animate__bounceIn">
        <a @auth href="/slots/real/{{$slotslist['_id']}}" @else href="/slots/demo/{{$slotslist['_id']}}" @endauth>
            <div class="group cursor-pointer shadow-md rounded-t-xl transition duration-400 ease transform translate-x-4 translate-y-4">
               <!-- <div class="absolute inset-0 z-10 bg-blue-100 rounded-t-xl text-center flex flex-col items-center justify-center opacity-0 hover:opacity-50 bg-opacity-50 duration-500 ease"></div> !-->
                <img class="thumbnail rounded-t-xl" src="https://cdn.apigamble.com/i/long/jpg/{{$slotslist['_id']}}.jpg" alt="">
                <div class="flex flex-col p-3 font-bold text-gray-700">
                    <p class="text-sm md:text-xs sm:text-xs">{{$slotslist['n']}}</p>
                    <p class="text-xs font-light text-gray-400 mt-1">
                        {{$slotslist['p']}}
                        <span class="text-xs opacity-0 float-right font-semibold text-blue-300 group-hover:opacity-100">play</span>
                    </p>
                </div>
            </div></a>
        </div>
        @endforeach


        </div>
<div class="d-flex justify-content-center">
{{ $slots->links() }}
</div>
    </x-app-layout> 