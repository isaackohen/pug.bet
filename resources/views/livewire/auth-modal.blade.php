<div>



    <div
        data-modal="auth-modal"
        class="invisible opacity-0 fixed inset-0 w-full h-full z-20 outline-none overflow-x-hidden overflow-y-auto transition-all"
        style="transition-duration: 200ms;"
        >
        <div
            data-modal-toggle="auth-modal"
            data-modal-action="close"
            class="fixed inset-0 w-full h-full bg-black bg-opacity-70"
        ></div>
        <div
            data-modal-main="auth-modal"
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
                            <x-jet-authentication-card>
                            <x-slot name="logo">
                            @livewire('logo-full')
                            </x-slot>
                            <x-jet-validation-errors class="mb-4" />
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div>
                                    <x-jet-label for="name" value="{{ __('Name') }}" />
                                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="email" value="{{ __('Email') }}" />
                                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="password" value="{{ __('Password') }}" />
                                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                </div>
                                <div class="mt-4">
                                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-jet-label for="terms">
                                    <div class="flex items-center">
                                        <x-jet-checkbox name="terms" id="terms"/>
                                        <div class="ml-2">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                    </x-jet-label>
                                </div>
                                @endif
                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>
                                    <x-jet-button class="ml-4">
                                    {{ __('Register') }}
                                    </x-jet-button>
                                </div>
                            </form>
                            </x-jet-authentication-card>
                            
                            @endauth
                        </p>
                    </main>
                    <footer class="flex justify-end p-2">
                        
                        <button data-modal-toggle="auth-modal" data-modal-action="close" class="inline-flex bg-blue-600 shadow-lg text-white rounded-full h-6 px-3 justify-center items-center hover:bg-blue-400"><i class="fas fa-times p-1 text-xs"></i></button>
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
        document.querySelector('[data-modal="auth-modal"]').addEventListener('hide', (event) => {
        console.log('hide');
        });
        </script>
    </div>