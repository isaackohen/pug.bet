<x-app-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ring-3 ring-indigo-40">
                <div class="gameWrapper filter drop-shadow-lg" style="min-width: 100%; ">
                    <iframe src="<?php echo $url; ?>" style="min-height: 100%; border: none !important;" border="0"></iframe>
                </div>
            </div>
        </div>
    <style>
    #balance-id {
        display: none;
    }
    </style>
    <script>
          const containerElement = document.getElementById("slotcontainer-toggle");
              function toggleClass() {
              const newClass = containerElement.className == "container-lg" ? "container-fluid slotcontainer-big" : "container-lg";
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

