<x-modal blur wire:model.defer="creditcard">
  <div x-data="{ paydashmodal: false}" :class="{'overflow-y-hidden': paydashmodal}">
<x-card title="Creditcard - Choose Amount">
    <x-slot name="action">
        <button class="rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600">
            <x-icon name="information-circle" class="w-4 h-4 text-gray-500" />
        </button>
    </x-slot>

<x-input value="{{auth()->user()->email}}" wire:model="email" icon="user" label="E-mail" placeholder="Your E-mail" />

<br>

<x-inputs.currency
    label="Currency"
    placeholder="Enter Amount"
    icon="currency-dollar"
    thousands="."
    decimal=","
    precision="2"
    wire:model="amount"
/>

        <div>
            <button wire:click="paydash_link()" class="block w-full mt-3 max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold"><i class="mdi mdi-lock-outline mr-1"></i> SECURE PAY NOW</button>
        </div>   

      </x-card>

    </div>

</x-modal>




