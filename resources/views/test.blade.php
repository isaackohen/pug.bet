<x-app-layout>


<div id="slotcontainer" class="container mx-auto px-8 sm:px-16">
    <div class="py-20">


    <div class="container">
  <div class="card p-1">
    <div id=parent>

                <div class="gameWrapper">
                    <iframe src="https://k1phjr1fwnw7ot9.gambleapi.com" style="border: none !important;" border="0"></iframe>
                </div>
    <div class="container">
        <a href="/">
      <button onclick="redirect('/')" title="Return to Home" class="btn btn-info p-1 m-1 ripple-surface" style="min-width: 45px; font-size: 12px;"><i class="fas fa-home"></i></button></a>
      <button id="fullscreeniframe" title="Play Full Screen" class="btn btn-secondary p-1 m-1 ripple-surface" style="min-width: 45px; font-size: 12px;"><i class="fas fa-expand"></i></button>
      <button onclick="toggleClass()" title="Toggle Width" class="btn btn-secondary p-1 m-1 ripple-surface" style="min-width: 45px; font-size: 12px;"><i class="far fa-rectangle-wide"></i></button>
      <button onclick="$.leaderboard()" title="Leaderboard" class="btn btn-secondary p-1 m-1 ripple-surface" style="min-width: 45px; font-size: 12px;"><i class="fad fa-trophy"></i></button>
    </div>
    </div>
  </div>
</div>
    </div>
</div>

  <script>
  const containerElement = document.getElementById("slotcontainer");
  function toggleClass() {
  const newClass = containerElement.className == "px-8" ? "px-1" : "px-8";
  containerElement.className = newClass;
  }
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
</x-app-layout>
