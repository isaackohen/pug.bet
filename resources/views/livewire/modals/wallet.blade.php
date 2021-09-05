<div>

<x-modal blur wire:model.defer="wallet">
    <x-card title="Wallet">


          <header class="flex flex-wrap">
        <button class="text-gray-600 py-2 px-4 block hover:text-blue-500 focus:outline-none text-blue-500 border-b-2 font-medium border-blue-500">
            Deposit
        </button><button class="text-gray-600 py-2 px-4 block hover:text-blue-500 focus:outline-none">
            Withdraw
        </button><button class="text-gray-600 py-2 px-4 block hover:text-blue-500 focus:outline-none">
            Transactions
        </button>

          </header>
          <main class="p-2 text-center">
            <p>
              @auth
              <div>
                <p>@livewire('payment-deposit-apipurse')</p> 
                <p>@livewire('paydash')</p> 

              @else
                <p>You need to be logged in to deposit or withdraw.</p>
              @endauth
            </p>
          </main>
 
      <button data-modal-toggle="balance-modal" data-modal-action="close" class="inline-flex bg-blue-600 shadow-lg text-white rounded-full h-6 px-3 justify-center items-center hover:bg-blue-400"><i class="fas fa-times p-1 text-xs"></i></button>


          </footer>
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" />
                <x-button primary label="I Agree" />
            </div>
        </x-slot>
    </x-card>
</x-modal>



</div>
