<div class="flex flex-wrap">
<div class="m-1 text-center">
  <div class="p-2">
    <div onclick="$openModal('wallets')"  class="inline-flex items-center bg-white leading-none text-blue-600 rounded-full p-2 shadow text-grey-700 text-sm hover:ring-4 hover:ring-indigo-300 cursor-pointer">
        <x-button rounded  spinner primary icon="cash" label="Wallet" />
      <span id="balance-id" class="inline-flex px-2 text-primary">Balance: &nbsp;<span class="text-primary font-semibold">{{auth()->user()->balance()}} </span>$</span> 
    </div>
  </div>
</div> 

<div class="m-1 text-center">
  <div class="p-2">
    <div onclick="$openModal('jackpotInfo')"  class="inline-flex items-center bg-white leading-none text-yellow-600 rounded-full p-2 shadow text-grey-700 text-sm hover:ring-4 hover:ring-yellow-600 cursor-pointer">
        <x-button rounded spinner warning icon="cash" label="Jackpot" />
      <span id="balance-id" class="inline-flex px-2 text-yellow-500"> &nbsp;<span class="text-yellow-500 font-semibold">{{\App\Models\Jackpot::jackpotAmount()}}</span>$</span> 
    </div>
  </div>
</div> 

@if(auth()->user()->freespins > 1)
<div class="m-1 text-center">
  <div class="p-2">
    <div onclick="$openModal('freespins')"  class="inline-flex items-center bg-white leading-none rounded-full p-2 shadow text-grey-700 text-sm hover:ring-4 hover:ring-green-500 cursor-pointer">
              <x-button icon="tag" rounded positive label="{{auth()->user()->freespins}} Free Spins" />
    </div>
  </div>
</div> 
@endif
  </div> 
