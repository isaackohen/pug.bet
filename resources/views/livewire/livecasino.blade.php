<x-app-layout>
<div>

<div class="flex flex-wrap max-w-7xl mx-auto sm:px-3 lg:px-4">
    @foreach($slots as $slotslist)
    <div data-tilt-scale="1.05" data-tilt-max="8" data-tilt-speed="400" data-tilt-perspective="1000" data-tilt class="xl:w-1/7 lg:w-1/6 md:w-1/4 sm:w-1/3 w-1/2 px-3 my-4 wire:loading.remove">
        <a @auth href="/slots/real/{{$slotslist['_id']}}" @else href="/slots/demo/{{$slotslist['_id']}}" @endauth>
            <div class="group cursor-pointer bg-gray-200 rounded-lg transition duration-400 ease transform translate-x-4 translate-y-4 top-5 hover:bg-primarysoft">
              <div class="absolute inset-0 z-10 bg-gray-100 rounded-t-lg text-center flex flex-col items-center justify-center opacity-20 hover:opacity-0 bg-opacity-0 duration-400 ease"></div>
                <img class="big-thumbnail rounded-t-lg" src="https://cdn.apigamble.com/i/long/jpg/{{$slotslist['_id']}}.jpg" alt="">
                <div class="flex flex-col p-3 font-semibold text-black group-hover:text-gray-100">
                    <p class="text-xs md:text-xs sm:text-xs">{{$slotslist['n']}}</p>
                    <p class="text-xs font-light text-gray-400 group-hover:text-gray-300 mt-1">
                        {{$slotslist['p']}}
                        <span class="text-xs opacity-0 float-right font-semibold text-blue-200 group-hover:opacity-100">play</span>
                    </p>
                </div>
            </div></a>
        </div>
        @endforeach
    </div>

        <div class="spacer mt-5 mb-5"></div>
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