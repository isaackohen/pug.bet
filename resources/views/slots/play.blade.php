<x-app-layout>
    <div class="max-w-7xl mt-6 mx-auto sm:px-6 lg:px-8">
        <div class="bg-component overflow-hidden rounded-t-component">
          <div class="gameWrapper" style="min-width: 100%; ">
          <iframe src="<?php echo $url; ?>" border="0"></iframe>
          </div>
        </div>

        <div class="container bg-component rounded-b-lg" style="min-width: 100%; ">
          <button onclick="redirect('/')" title="Return to Home" class="btn btn-info text-default p-1 m-1" style="min-width: 50px; font-size: 12px;"><i class="fas fa-home"></i></button>
          <button id="fullscreeniframe" title="Play Full Screen" class="btn btn-secondary text-default p-1 m-1" style="min-width: 50px; font-size: 12px;"><i class="fas fa-expand"></i></button>
          <a @if($mode === 'Demo Mode')
          href="/slots/real/{{$id_game}}"
          @else
          href="/slots/demo/{{$id_game}}"
          @endif>
          <button title="{{$mode}}" class="btn-primary text-default p-1 m-1" style="float:right; min-width: 45px; font-size: 12px;">{{$mode}} <i class="far fa-toggle-on"></i></button></a>
        </div>

        <div class="container bg-component rounded-lg px-2 py-4 mt-4" style="min-width: 100%;">
          <img class="absolute w-6 h-6 ml-1 rounded-full shadow-inner" src="https://cdn.apigamble.com/i/long/jpg/{{$name_game['_id']}}.jpg?width=30" alt="" />
          <div class="text-default ml-9">
           {{$name_game['n']}} <small>by {{$name_game['p']}}</small>

        </div>
        </div>

      @php
        $slotslist = DB::table('slotslist')->where('disabled', '!=', '0')->where('p', '=', $name_game['p'])->get()->random(3);
        $slotslist2 = DB::table('slotslist')->where('disabled', '!=', '0')->get()->random(30);
      @endphp

      <div class="mt-10 ml-2"><span>Other Games</span> <div class="flex flex-wrap float-right" style="float: right;" id="c1-arrows"></div></div>
      <div id="c1" class="flex flex-wrap">
      @foreach($slotslist->shuffle() as $game)
        <div class="w-1/6 sm:p-2 p-2 my-1 pulse">
            <a @auth href="/slots/real/{{$game['_id']}}" @else href="/slots/demo/{{$game['_id']}}" @endauth>
                <div class="group cursor-pointer bg-gray-200 rounded-lg transition duration-400 ease hover:bg-primary hover:shadow-2xl">
                    <div class="absolute inset-0 z-10 bg-gray-100 rounded-t-lg text-center flex flex-col items-center justify-center opacity-20 hover:opacity-0 bg-opacity-0 duration-300 ease"></div>
                    <img class="big-thumbnail rounded-t-lg" src="https://cdn.bulk.bet/i/long/jpg/{{$game['_id']}}.jpg?width=250" alt="">
                    <div class="flex flex-col p-3 font-semibold text-black group-hover:text-gray-100">
                        <p class="text-xs md:text-xs sm:text-xs">{{$game['n']}}</p>
                        <p class="text-xs font-light text-gray-400 group-hover:text-gray-300 mt-1">
                            {{$game['p']}}
                            <span class="text-xs opacity-0 float-right font-semibold text-blue-200 group-hover:opacity-100">play</span>
                        </p>
                    </div>
                </div></a>
            </div>
        @endforeach
      @foreach($slotslist2->shuffle() as $game)
        <div class="w-1/6 sm:p-2 p-2 my-1 pulse">
            <a @auth href="/slots/real/{{$game['_id']}}" @else href="/slots/demo/{{$game['_id']}}" @endauth>
                <div class="group cursor-pointer bg-gray-200 rounded-lg transition duration-400 ease hover:bg-primary hover:shadow-2xl">
                    <div class="absolute inset-0 z-10 bg-gray-100 rounded-t-lg text-center flex flex-col items-center justify-center opacity-20 hover:opacity-0 bg-opacity-0 duration-300 ease"></div>
                    <img class="big-thumbnail rounded-t-lg" src="https://cdn.bulk.bet/i/long/jpg/{{$game['_id']}}.jpg?width=250" alt="">
                    <div class="flex flex-col p-3 font-semibold text-black group-hover:text-gray-100">
                        <p class="text-xs md:text-xs sm:text-xs">{{$game['n']}}</p>
                        <p class="text-xs font-light text-gray-400 group-hover:text-gray-300 mt-1">
                            {{$game['p']}}
                            <span class="text-xs opacity-0 float-right font-semibold text-blue-200 group-hover:opacity-100">play</span>
                        </p>
                    </div>
                </div></a>
            </div>
        @endforeach
    </div>
    </div>


    @livewire('latestgames', ['rowlength' => '10'])s

    </x-app-layout>

  <script>

  (function(window, document){
  var $ = function(selector,context){return(context||document).querySelector(selector)};
  var iframe = $("iframe"),
  domPrefixes = 'Webkit Moz O ms Khtml'.split(' ');
  var fullscreen = function(elem) {
  var prefix;
  // Mozilla and webkit intialise fullscreen slightly differently
  for ( var i = -1, len = domPrefixes.length; ++i < len; ) {
  prefix = domPrefixes[i].toLowerCase();
  if ( elem[prefix + 'EnterFullScreen'] ) {
  // Webkit uses EnterFullScreen for video
  return prefix + 'EnterFullScreen';
  break;
  } else if( elem[prefix + 'RequestFullScreen'] ) {
  // Mozilla uses RequestFullScreen for all elements and webkit uses it for non video elements
  return prefix + 'RequestFullScreen';
  break;
  }
  }
  return false;
  };
  // Webkit uses "requestFullScreen" for non video elements
  var fullscreenother = fullscreen(document.createElement("iframe"));
  if(!fullscreen) {
  alert("Fullscreen won't work, please make sure you're using a browser that supports it and you have enabled the feature");
  return;
  }
  $("#fullscreeniframe").addEventListener("click", function(){
  // iframe fullscreen and non video elements in webkit use request over enter
  iframe[fullscreenother]();
  }, false);
  })(this, this.document);
  </script>