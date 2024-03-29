@auth



<x-modal wire:model.defer="wallets">
    <div class="container mx-auto px-4 sm:px-8">
    <div class="py-12">
       <div class="inline-flex items-center bg-white leading-none ring-4 ring-blue-40 text-blue-600 rounded-full p-2 mb-5 shadow text-grey-700 text-sm hover:ring-4 hover:ring-blue-10 cursor-pointer">
      
      <span id="balance-id" class="inline-flex px-2 text-blue-400">Your Balance: &nbsp;<span class="text-blue-500 font-semibold">{{auth()->user()->balance()}} </span>$</span>
    </div>

<x-card title="Deposit - Cryptocurrency">
    <x-slot name="action">

    </x-slot>

<a href="#_" wire:click="bitcoin()" class="px-5 m-1 py-2.5 font-medium bg-blue-50 hover:bg-blue-100 hover:text-blue-600 text-blue-500 rounded-lg text-sm">
    Bitcoin
</a>
<a href="#_" wire:click="bitcoingold()" class="px-5 m-1 py-2.5 font-medium bg-blue-50 hover:bg-blue-100 hover:text-blue-600 text-blue-500 rounded-lg text-sm">
    Bitcoin Gold
</a>  
<a href="#_" wire:click="litecoin()" class="px-5 m-1 py-2.5 font-medium bg-blue-50 hover:bg-blue-100 hover:text-blue-600 text-blue-500 rounded-lg text-sm">
    Litecoin
</a>  
<a href="#_" wire:click="dogecoin()"
class="px-5 m-1 py-2.5 font-medium bg-blue-50 hover:bg-blue-100 hover:text-blue-600 text-blue-500 rounded-lg text-sm">
    Dogecoin
</a>       
</x-card>
<div class="mt-5 mb-5"></div>
<div class="mt-5 mb-5"></div>

<x-card title="Deposit - Instant Third Party">
    <x-slot name="action">
        <button class="rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600">
            <x-icon name="information-circle" class="w-4 h-4 text-gray-500" />
        </button>
    </x-slot>
    <script type="text/javascript">
      window.__SIDESHIFT__ = {
        parentAffiliateId: "NXuHDSa0R",
        defaultDepositMethodId: "eth",
        defaultSettleMethodId: "ltc",
        settleAddress: "{{$wallet2}}",
      }
    </script>
        <script src="https://sideshift.ai/static/js/main.js"></script>

        <button onclick="window.sideshift.show()" class="px-5 m-1 py-2.5 font-medium bg-blue-50 hover:bg-blue-100 hover:text-blue-600 text-blue-500 rounded-lg text-sm">
            <div class="flex flex-wrap">
                <img src="https://sideshift.ai/static/media/eth.18708d3e.svg" class="h-4 mr-1">
                <img src="https://sideshift.ai/static/media/bch.274d44f0.svg" class="h-4 mr-1">
                <img src="https://sideshift.ai/static/media/usdt.66f1b147.svg" class="h-4 mr-1">
                <img src="https://sideshift.ai/static/media/bnb.f78cb0ac.svg" class="h-4 mr-1">
            </div>

                
           <p onclick="window.sideshift.show()">Instant crypto-swap with SIDESHIFT.AI</p>
        </button>

        <button href="#_" onclick="$openModal('creditcard')" class="px-5 m-1 py-2.5 font-medium bg-blue-50 hover:bg-blue-100 hover:text-blue-600 text-blue-500 rounded-lg text-sm">
            <div class="flex flex-wrap">
                <img src="/img/payments/visa.svg" class="h-4 mr-1">
                <img src="/img/payments/mastercard.svg" class="h-4 mr-1">
                <img src="/img/payments/amex.svg" class="h-4 mr-1">
            </div>
          <p>Pay Secure by CREDITCARD</p>
        </button>


      </x-card>
      @livewire('paydash')

    <div class="mt-5 mb-5"></div>
    <div class="mt-5 mb-5"></div>

    <x-card title="Complete Surveys & Gain Crypto for Free">
        <x-slot name="action">
            <button class="rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600">
                <x-icon name="information-circle" class="w-4 h-4 text-gray-500" />
            </button>
        </x-slot>
            <button href="/offertoro" class="px-5 m-1 py-2.5 font-medium bg-blue-50 hover:bg-blue-100 hover:text-blue-600 text-blue-500 rounded-lg text-sm">
              <p>Check your Offers</p>
            </button>
    </x-card>

    <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
            <x-button flat label="Cancel" x-on:click="close" />
            <x-button primary label="Support" />
        </div>
    </x-slot>
</div>
</div>
</x-modal>




@endauth


