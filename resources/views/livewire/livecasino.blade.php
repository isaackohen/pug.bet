<x-app-layout>
<div>
    <div class="flex flex-wrap mt-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach($slots as $slotslist)
 

        <div class="xl:w-1/7 lg:w-1/6 md:w-1/4 sm:w-1/3 xs:w-1/3 w-1/2 my-4 px-4 sm:my-1">
            <a @auth href="/slots/real/{{$slotslist['_id']}}" @else href="/slots/demo/{{$slotslist['_id']}}" @endauth>
                <div class="group cursor-pointer shadow-md rounded-t-xl transition duration-400 ease transform translate-x-4 translate-y-4">
                    <div class="absolute inset-0 z-10 bg-blue-300 rounded-t-xl text-center flex flex-col items-center justify-center opacity-0 hover:opacity-50 bg-opacity-50 duration-300 ease"></div>
                    <img wire:loading.class="bg-gray" class="thumbnail rounded-t-xl group-hover:shadow-inner group-hover:shadow-xlr" src="https://cdn.static.bet/i/long/jpg/{{$slotslist['_id']}}.jpg" alt="">
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




        <div class="spacer mt-5 mb-5"></div>
@php

$user = auth()->user();
$user->add('5.00', "usd", "deposit", "nothing");
        @endphp

        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-12">
                <aside class="relative overflow-hidden text-gray-300 bg-gray-900 rounded-xl lg:flex">
                    <div class="w-full p-12 text-center lg:w-1/2 sm:p-16 lg:p-24 lg:text-left">
                        <div class="max-w-xl mx-auto lg:ml-0">w
                            <p class="text-xs text-grey-200 font-semibold">
                                LIVE CASINO
                            </p>
                            <p class="mt-2 text-2xl font-bold text-white sm:text-3xl">
                                Place your bet at our Live Casino Studios
                            </p>
                            <p class="hidden lg:mt-4 lg:block">
                                Our dealers will make sure to give you a warm welcome.
                            </p>
                            <p class="hidden lg:mt-4 lg:block">
                                Play with your friends Blackjack and many other table games.
                            </p>
                        </div>
                    </div>
                    <div class="relative w-full h-59 sm:h-88 lg:w-1/2.5 lg:h-auto">
                    <video id="comp-kiz6mhxu_video" class="_3vVMz" role="presentation" crossorigin="anonymous" playsinline="" preload="auto" muted="" loop="" autoplay="" tabindex="-1" width="100%" height="100%" src="https://video.wixstatic.com/video/53df50_1d8c6f782ac94ae69d76f08d5056f4cb/1080p/mp4/file.mp4" style="width: 100%; height: 100%; object-fit: cover; object-position: center center; opacity: 1;"></video>
                </div>
            </aside>
        </div>
    </div>
</div>
</x-app-layout>