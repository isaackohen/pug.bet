<div style="text-align: center">
    <style>
[multiple], [type=date], [type=datetime-local], [type=email], [type=month], [type=number], [type=password], [type=search], [type=tel], [type=text], [type=time], [type=url], [type=week], select, textarea {
    border-color: transparent !important;
}
.tooltip {
  position: relative;
  width:  100%;
  display: inline-block;
  cursor: pointer;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 200px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 9px;
  padding: 5px;
  font-size:  12px;
  position: absolute;
  z-index: 1;
  bottom: 104%;
  left: 50%;
  margin-left: -75px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}


</style>
<div class="container-fluid px-5">

      <div class="inline-flex items-center bg-white leading-none ring-4 ring-blue-40 text-blue-600 rounded-full p-2 mb-5 shadow text-grey-700 text-sm hover:ring-4 hover:ring-blue-10 cursor-pointer">
      
      <span id="balance-id" class="inline-flex px-2 text-blue-400">Your Balance: &nbsp;<span class="text-blue-500 font-semibold">{{auth()->user()->balance()}} </span>$</span>
    </div>


  <div class="space-y-4">

  <div class="tooltip cursor-pointer">
    <div onclick="copyBtc()" class="flex cursor-pointer items-center p-2 space-x-2 rounded-xl bg-blue-100 rounded-md p-2 text-white cursor-pointer transition duration-300 ease-in-out hover:shadow hover:bg-blue-400">
      <div class="flex bg-gray-100 p-2 w-full space-x-2 rounded-lg">
        <input id="wallet-btc" class="w-full cursor-pointer text-black outline-none text-sm" disabled type="text" value="{{ $wallet }}" placeholder="Generating..." />
      </div>
      <span class="tooltiptext cursor-pointer" id="tooltip-btc">Click to copy address</span>
      <div class="bg-yellow-500 cursor-pointer py-2 px-3 opacity-90 text-white font-medium rounded-xl w-60 hover:shadow-lg transition duration-200 cursor-pointer">
        <span>bitcoin</span>
      </div>
    </div>
  </div>
  <div class="tooltip cursor-pointer">
    <div onclick="copyBtg()" class="flex cursor-pointer items-center p-2 space-x-2 rounded-xl bg-blue-100 rounded-md p-2 text-white cursor-pointer transition duration-300 ease-in-out hover:shadow hover:bg-blue-400">
      <div class="flex bg-gray-100 p-2 w-full space-x-2 rounded-lg">
        <input id="wallet-btg" class="w-full cursor-pointer text-black outline-none text-sm" disabled type="text" value="{{ $wallet4 }}" placeholder="Generating..." />
      </div>
      <span class="tooltiptext cursor-pointer" id="tooltip-btg">Click to copy address</span>
      <div class="bg-yellow-600 cursor-pointer py-2 px-3 opacity-90 text-white font-medium rounded-xl w-60 hover:shadow-lg transition duration-200 cursor-pointer">
        <span>bitcoingold</span>
      </div>
    </div>
  </div>
  <div class="tooltip cursor-pointer">
    <div onclick="copyLtc()" class="flex cursor-pointer items-center p-2 space-x-2 rounded-xl bg-blue-100 rounded-md p-2 text-white cursor-pointer transition duration-300 ease-in-out hover:shadow hover:bg-blue-400">
      <div class="flex bg-gray-100 p-2 w-full space-x-2 rounded-lg">
        <input id="wallet-ltc" class="w-full cursor-pointer text-black outline-none text-sm" disabled type="text" value="{{ $wallet2 }}" placeholder="Generating..." />
      </div>
      <span class="tooltiptext cursor-pointer" id="tooltip-ltc">Click to copy address</span>
      <div class="bg-gray-600 cursor-pointer py-2 px-3 opacity-90 text-white font-medium rounded-xl w-60 hover:shadow-lg transition duration-200 cursor-pointer">
        <span>litecoin</span>
      </div>
    </div>
  </div>
  <div class="tooltip cursor-pointer">
    <div onclick="copyDoge()" class="flex cursor-pointer items-center p-2 space-x-2 rounded-xl bg-blue-100 rounded-md p-2 text-white cursor-pointer transition duration-300 ease-in-out hover:shadow hover:bg-blue-400">
      <div class="flex bg-gray-100 p-2 w-full space-x-2 rounded-lg">
        <input id="wallet-doge" class="w-full cursor-pointer text-black outline-none text-sm" disabled type="text" value="{{ $wallet3 }}" placeholder="Generating..." />
      </div>
      <span class="tooltiptext cursor-pointer" id="tooltip-doge">Click to copy address</span>
      <div class="bg-yellow-400 cursor-pointer py-2 px-3 opacity-90 text-white font-medium rounded-xl w-60 hover:shadow-lg transition duration-200 cursor-pointer">
        <span>dogecoin</span>
      </div>
    </div>
  </div>
 </div>
</div>


<script>
function copyBtc() {
  var copyText = document.getElementById("wallet-btc");

  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  navigator.clipboard.writeText(copyText.value);
  var tooltip = document.getElementById("tooltip-btc");
  var tooltipltc = document.getElementById("tooltip-ltc");
  var tooltipdoge = document.getElementById("tooltip-doge");

  tooltip.innerHTML = "Copied BTC address to clipboard!";
  tooltipltc.innerHTML = "Click to copy address";
  tooltipdoge.innerHTML = "Click to copy address";
}

function copyLtc() {
  var copyText = document.getElementById("wallet-ltc");

  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  navigator.clipboard.writeText(copyText.value);
  
  var tooltip = document.getElementById("tooltip-ltc");
  var tooltipbtc = document.getElementById("tooltip-btc");
  var tooltipdoge = document.getElementById("tooltip-doge");

  tooltip.innerHTML = "Copied LTC address to clipboard!";
  tooltipbtc.innerHTML = "Click to copy address";
  tooltipdoge.innerHTML = "Click to copy address";

}

function copyDoge() {
  var copyText = document.getElementById("wallet-doge");

  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  navigator.clipboard.writeText(copyText.value);
  var tooltip = document.getElementById("tooltip-doge");
  var tooltipbtc = document.getElementById("tooltip-btc");
  var tooltipltc = document.getElementById("tooltip-ltc");
  tooltip.innerHTML = "Copied DOGE address to clipboard!";
  tooltipbtc.innerHTML = "Click to copy address";
  tooltipltc.innerHTML = "Click to copy address";

}

function copyBtg() {
  var copyText = document.getElementById("wallet-btg");

  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  navigator.clipboard.writeText(copyText.value);
  var tooltip = document.getElementById("tooltip-btg");
  var tooltipbtc = document.getElementById("tooltip-btc");
  var tooltipltc = document.getElementById("tooltip-ltc");
  var tooltipdoge = document.getElementById("tooltip-doge");
  tooltip.innerHTML = "Copied BTG address to clipboard!";
  tooltipbtc.innerHTML = "Click to copy address";
  tooltipltc.innerHTML = "Click to copy address";
  tooltipdoge.innerHTML = "Click to copy address";

}


</script>


</div>