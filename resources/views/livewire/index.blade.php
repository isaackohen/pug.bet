      <main class="py-2 container mx-auto md:px-0">
     
    <!-- Slider !-->
    <div id="slider" class="slider-wrapper mb-6">

    <div class="slick-slide">
    <div class="container bg-primary h-80 rounded-md bg-no-repeat flex items-center" style="background-image: url(/img/intro.png)">
      <div class="sm:ml-20 text-gray-50 text-center sm:text-left">
        <h1 class="text-3xl font-bold mb-4" >
          Bulk.bet <br />
        </h1>
        <p class="text-lg inline-block sm:block">Full fledged casino solutions.<br />35+ Game Providers, Poker and Custom Development.</p>
        <br />
        <button class="mt-8 px-4 py-2 bg-gray-600 rounded-md">Browse Games       
        </button> @auth @else<button class="mt-8 px-4 py-2 bg-secondary rounded-md">Register</button> @endauth
      </div>
    </div>
  </div>

    <div class="slick-slide">
    <div class="container bg-primarysoft h-80 rounded-md bg-no-repeat flex items-center" style="background-image: url(/img/intro-2.png)">
      <div class="sm:ml-20 text-gray-50 text-center sm:text-left">
        <h1 class="text-3xl font-bold mb-4" >
          Payment Processor <br />
        </h1>
        <p class="text-lg inline-block sm:block">Accept Payments<br />In every cryptocurrency,
          <br />
        ERC20/TRC20/BEP20 token and we offer creditcard-to-crypto gateway.</p>
        <br />
        <button class="mt-8 px-4 py-2 bg-secondary rounded-md">Contact</button>
      </div>
    </div>
  </div>
  <!--
    <div class="slick-slide">
    <div class="container bg-primary h-96 rounded-md bg-no-repeat flex items-center" style="background-image: url(/img/vip.jpg)">
    </div>

  !-->
  </div>
    @auth
        <header class="font-header">
            <div id="second-header" class="max-w-7xl mx-auto p-2">
                @livewire('balance')
            </div>
        </header>
    @endauth

    <button wire:click.prefetch="toggleContent">Show Content</button>
 
    @if ($contentIsVisible)
        <span>Some Content...</span>
    @endif

    <!-- Bonuses !-->
    <section>
      <h1 class="text-3xl font-bold text-gray-600 mb-4">Casino Bonus</h1>
      <div class="grid sm:grid-cols-3 gap-4 grid-cols-2 zoom-in">
        <a href="/bonus/">
        <div>
          <div class="bg-primary js-tilt h-44 bg-cover cursor-pointer shadow-2xl bg-no-repeat rounded-md opacity-80 hover:opacity-95 hover:pb-5" style="background-image: url(/img/faucet.png)"></div>
          <h3 class="text-lg font-semibold text-gray-500 mt-2">Start with <span class="text-primary">Free Faucet</span></h3>
        </div>
        </a>
        <div>
          <a href="/bonus/">
          <div class="bg-primary js-tilt h-44 bg-cover cursor-pointer shadow-2xl bg-no-repeat rounded-md opacity-80 hover:opacity-95 hover:pb-5" style="background-image: url(/img/depositbonus.png)"></div>
          <h3 class="text-lg font-semibold text-gray-500 mt-2">First <span class="text-primary">200% </span>Deposit Bonus</h3>
          </a>
        </div>
        <div>
        <a href="/bonus/">
          <div class="bg-primary h-44 bg-cover cursor-pointer shadow-2xl bg-no-repeat rounded-md opacity-80 hover:opacity-95 hover:pb-5" style="background-image: url(/img/jackpot.png)"></div>
          <h3 class="text-lg font-semibold text-gray-500 mt-2">Fair <span class="text-primary">Progressive Jackpot</span> every bet</h3>
        </a>
        </div>
      </div>
    </section>


  </main>


