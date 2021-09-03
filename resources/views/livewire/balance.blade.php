<div>

<div class="m-1 text-center">
  <div class="p-2">
    <div data-modal-toggle="balance-modal"
        data-modal-action="open" class="inline-flex items-center bg-white leading-none text-blue-600 rounded-full p-2 shadow text-grey-700 text-sm hover:ring-4 hover:ring-indigo-30 cursor-pointer">
      
      <span class="inline-flex bg-blue-600 shadow-lg text-white rounded-full h-6 px-3 justify-center items-center hover:bg-blue-500"><i class="fas fa-wallet p-2 text-xs"></i> Wallet</span>

      <span id="balance-id" class="inline-flex px-2 text-blue-400">Your Balance: &nbsp;<span class="text-blue-500 font-semibold">{{auth()->user()->balance()}} </span>$</span>
    </div>
  </div>
</div>
    <div
      data-modal="balance-modal"
      class="invisible opacity-0 fixed inset-0 w-full h-full z-20 outline-none overflow-x-hidden overflow-y-auto transition-all"
      style="transition-duration: 200ms;"
     >
      <div
        data-modal-toggle="balance-modal"
        data-modal-action="close"
        class="fixed inset-0 w-full h-full bg-black bg-opacity-70"
      ></div>
      <div
        data-modal-main="balance-modal"
        class="modal relative w-auto my-8 mx-4 pointer-events-none transition-all duration-200 transform -translate-y-full">
        <div class="relative shadow-lg rounded-md w-full pointer-events-auto bg-white text-gray-800 max-w-screen-lg mx-auto">
          <header class="flex flex-wrap p-1">
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
          <footer class="flex justify-end p-2">
 
      <button data-modal-toggle="balance-modal" data-modal-action="close" class="inline-flex bg-blue-600 shadow-lg text-white rounded-full h-6 px-3 justify-center items-center hover:bg-blue-400"><i class="fas fa-times p-1 text-xs"></i></button>


          </footer>
        </div>
      </div>
    </div>

  <script>
    const modal = (el) => {
      const toggle = (wrapperEl, mainEl) => {
        document.querySelector('body').classList.toggle('overflow-y-hidden');
        wrapperEl.classList.toggle('opacity-100');
        wrapperEl.classList.toggle('opacity-0');
        wrapperEl.classList.toggle('visible');
        wrapperEl.classList.toggle('invisible');
        mainEl.classList.toggle('-translate-y-full');
        mainEl.classList.toggle('translate-y-0')
      };

      const extractElements = (target) => {
        const wrapper = document.querySelector(`[data-modal='${target}']`);
        const modal = wrapper.querySelector('[data-modal-main]');
        return { wrapper, modal };
      };

      const showEvent = new CustomEvent('show', {
        detail: {},
        bubbles: true,
        cancelable: true,
        composed: false,
      });

      const hideEvent = new CustomEvent('hide', {
        detail: {},
        bubbles: true,
        cancelable: true,
        composed: false,
      });

      if (!document.querySelector('[data-modal-toggle]')) {
        return;
      }

      if (!document.querySelector('[data-modal')) {
        return;
      }

      [...document.querySelectorAll('[data-modal-toggle]')].forEach((btn) =>
        btn.addEventListener('click', (event) => {
          event.preventDefault();
          const action = btn.getAttribute('data-modal-action');
          const target = btn.getAttribute('data-modal-toggle');
          const { wrapper, modal } = extractElements(target);

          if (action === 'open') {
            modal.dispatchEvent(showEvent);
          }
          if (action === 'close') {
            modal.dispatchEvent(hideEvent);
          }
          toggle(wrapper, modal);
        })
      );
    };

    // init
    modal();

    // This event is fired immediately before modal is start hidding
    document.querySelector('[data-modal="balance-modal"]').addEventListener('hide', (event) => {
      console.log('hide');
    });
  </script>
</div>
