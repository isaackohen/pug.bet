<x-app-layout>
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 animate__pulse">
                    @livewire('faucet')
                    @livewire('modals.promocode')
<div>
  <div class="containter mx-auto mt-10 px-20">
    <div class="bg-component p-8 rounded-component shadow-sm relative hover:shadow-lg transition duration-500">
      <h1 class="text-2xl text-default font-semibold mb-3">Promocode</h1>
      <p class="text-defaultsoft leading-6 tracking-normal">Every 10 minutes you are able to use a promocode, distributed on our social channels.</p>
            <button  onclick="$openModal('promocode')" class="py-2 px-4 mt-8 bg-primarysoft text-white rounded-md shadow-xl">Use Promocode</button>
    </div>
  </div>
</div>




            </div>             

            </div>
            </div>  

        <x-notifications z-index="z-50" />



</x-app-layout>
