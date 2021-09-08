<div>

<div class="m-1 text-center">
  <div class="p-2">

    <div onclick="$openModal('wallet')"  class="inline-flex items-center bg-white leading-none text-blue-600 rounded-full p-2 shadow text-grey-700 text-sm hover:ring-4 hover:ring-primary cursor-pointer">
      
<x-button rounded  spinner primary icon-home label="Wallet" />

      <span id="balance-id" class="inline-flex px-2 text-blue-400">Your Balance: &nbsp;<span class="text-blue-500 font-semibold">{{auth()->user()->balance()}} </span>$</span>
    </div>
  </div>
</div>
  
</div>
