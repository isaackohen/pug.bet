<div class="flex flex-wrap mt-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
    @foreach($slots as $slotslist)
    <div class="xl:w-1/7 lg:w-1/6 md:w-1/5 sm:w-1/4 w-1/2 px-3 my-4 wire:loading.remove">
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
    