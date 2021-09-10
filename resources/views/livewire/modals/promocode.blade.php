
<x-modal blur wire:model.defer="promocode">

<x-card title="Promocode">


<x-input
    label="Enter Promocode"
    placeholder="Enter Code"
    icon="terminal"
    thousands="."
    decimal=","
    precision="0"
    wire:model="code"
/>

        <div>
            <button wire:click="usePromocode()" class="block mt-2 w-full max-w-xs mx-auto bg-primary hover:bg-primarysoft text-white rounded-lg px-3 py-3 font-semibold"><i class="mdi mdi-lock-outline mr-1"></i> Use Code</button>
        </div>   

      </x-card>


</x-modal>
