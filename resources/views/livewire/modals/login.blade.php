<x-modal wire:model.defer="login">
     <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

<div class="bg-no-repeat bg-cover bg-center relative" >
  <div class="min-h-screen sm:flex sm:flex-row mx-0 justify-center">

      <div class="flex justify-center self-center">
        <div class="p-12 bg-white mx-auto rounded-2xl w-full">
            <div class="mb-4">
              <h3 class="font-semibold text-2xl text-gray-800">Sign In </h3>
              <p class="text-gray-500">Please sign in to your account.</p>
            </div>
                     <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="identity" value="{{ __('Email') }}" />
                <x-jet-input id="identity" class="block mt-1 w-full" type="text" name="identity" :value="old('identity')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
<!--

<div class="row justify-content-center">
        <div class="col-lg-4 text-center">
            <div class="form-group">
                <h3>Enter Amount Here</h3>
                <input type="text" class="form-control" name="amount" id="inp_amount" aria-describedby="helpId"
                    placeholder="Enter Amount In USD">
            </div>
            <button type="button" onClick="startProcess()" class="btn btn-success mt-4">Pay Now</button>
        </div>
    </div>
!-->
        </div>
      </div>
  </div>
</div>
</x-jet-authentication-card>

</x-modal>

