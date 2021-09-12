            <div>
                <div class="container mx-auto mt-8 px-5 pulse">
                    <div class="bg-component p-6 rounded-component shadow-sm relative transition duration-300">
                        <h1 class="text-2xl text-default font-semibold mb-3">Rakeback</h1>
                        <p class="text-defaultsoft leading-6 tracking-normal">We give back percentage on every bet you place. Receive extra bonuses when reaching certain rake thresholds.</p>
                        <p class="text-defaultsoft leading-6 tracking-normal">You are free to cash-in your rake at any time and which has no additional wager requirements.</p>
                        <br>
                        @auth
                        <div wire:poll>
                        <p class="text-defaultsoft leading-6 tracking-normal"> Your available rakeback balance: <span class="text-primary font-semibold">{{ auth()->user()->rake / 100 }}$</span></p>
                        </div>
                        @endauth

                        <button wire:click="useRakeback()" class="py-2 px-4 mt-4 bg-primary text-white hover:bg-primarysoft rounded-component hover:shadow-2xl">Cash Rakeback</button>
                    </div>
                </div>
            </div>