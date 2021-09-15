<x-app-layout>
    @auth
        <header class="font-header">
            <div id="second-header" class="flex flex-wrap justify-center max-w-7xl mx-auto p-2">
                @livewire('balance')
            </div>
        </header>
    @endauth
<div class="container mx-auto px-3 sm:px-y-3">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('jackpot-section')
            @livewire('faucet')
            @livewire('modals.promocode')
            @livewire('modals.rakeback')
            
            <div>
                <div class="container mx-auto mt-8 px-5 pulse">
                    <div class="bg-component p-6 rounded-component shadow-sm relative transition duration-300">
                        <h1 class="text-2xl text-default font-semibold mb-3">Promocode</h1>
                        <p class="text-defaultsoft leading-6 tracking-normal">Every 10 minutes you are able to use a promocode, distributed on our social channels.</p>
                        <button onclick="$openModal('promocode')" class="py-2 px-4 mt-4 bg-primary text-white hover:bg-primarysoft rounded-component hover:shadow-2xl">Enter Code</button>
                    </div>
                </div>
            </div>
            <div>
                <div class="container mx-auto mt-8 px-5 pulse">
                    <div class="bg-component p-6 rounded-component shadow-sm relative transition duration-300">
                        <h1 class="text-2xl text-default font-semibold mb-3">Complete Surveys & Install Apps</h1>
                        <p class="text-defaultsoft leading-6 tracking-normal">Get instant cryptocurrency, just by taking your time to complete surveys, install apps and play mobile games.</p>
                        <a href="/offertoro"><button class="py-2 px-4 mt-4 bg-primary text-white hover:bg-primarysoft rounded-component hover:shadow-2xl">Check your offers</button></a>
                    </div>
                </div>
            </div>
            <div>
                <div class="container mx-auto mt-8 px-5 pulse">
                    <div class="bg-component p-6 rounded-component relative hover:shadow-sm transition duration-300">
                        <h1 class="text-2xl text-default font-semibold mb-5">VIP Benefits</h1>
                        <p class="text-defaultsoft leading-6 tracking-normal">Simply by playing, you unlock VIP benefits.
                            @auth Your VIP level is currently at <span class="text-primary font-semibold">level {{ auth()->user()->viplevel }}</span>. @endauth</p>
                        <br>
                        <p class="text-defaultsoft leading-6 tracking-normal">Be it increased rakeback, chance to win jackpot and not to forget <span class="text-primary font-md">every VIP level-up you receive a bunch of free spins.</span></p>
                        <div class="mt-5 hidden sm:flex flex-col show">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-t-2xl">
                                        <table class="min-w-full divide-y divide-gray-200 rounded-t-2xl">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        VIP Level
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Rakeback
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Promocode
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Faucet
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Jackpot
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Free Spins
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach(\App\Models\VIP\VipLevels::orderBy('level', 'asc')->get() as $viplevel)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ $viplevel->level }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">+{{ ($viplevel->rake_percent / 100) }}%</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">+{{ ($viplevel->promocode_bonus) }}%</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">+{{ ($viplevel->faucet_bonus) }}%</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">+{{ ($viplevel->jackpot_bonus) }}%</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-primary">{{ ($viplevel->fs_bonus) }} FS</div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
</x-app-layout>