            <div>
                <div class="container mx-auto mt-8 px-5 pulse">
                    <div class="bg-component p-6 rounded-component shadow-sm relative transition duration-300">
                        <h1 class="text-2xl text-default font-semibold mb-3">Promocode</h1>
                        <p class="text-defaultsoft leading-6 tracking-normal">Every 10 minutes you are able to use a promocode, distributed on our social channels.</p>
                                <button onclick="$openModal('promocode')" class="py-2 px-4 mt-4 bg-primary text-white hover:bg-primarysoft rounded-component hover:shadow-2xl">Enter Code</button>
                    </div>
                </div>
            </div>

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
                        <button wire:click="useRakeback()" class="py-2 px-4 mt-4 bg-primary text-white hover:bg-primarysoft rounded-component hover:shadow-2xl">Cash Rakeback</button>
        </div>   

      </x-card>


</x-modal>
