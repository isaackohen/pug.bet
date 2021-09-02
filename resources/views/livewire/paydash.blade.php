<div x-data="{ paydashmodal: false}" :class="{'overflow-y-hidden': paydashmodal}">


  </style>
<style>@import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);</style>
<style>
/*
module.exports = {
    plugins: [require('@tailwindcss/forms'),]
};
*/
.form-radio {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  -webkit-print-color-adjust: exact;
          color-adjust: exact;
  display: inline-block;
  vertical-align: middle;
  background-origin: border-box;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  flex-shrink: 0;
  border-radius: 100%;
  border-width: 2px;
}

.form-radio:checked {
  background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
  border-color: transparent;
  background-color: currentColor;
  background-size: 100% 100%;
  background-position: center;
  background-repeat: no-repeat;
}

@media not print {
  .form-radio::-ms-check {
    border-width: 1px;
    color: transparent;
    background: inherit;
    border-color: inherit;
    border-radius: inherit;
  }
}

.form-radio:focus {
  outline: none;
}

.form-select {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23a0aec0'%3e%3cpath d='M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z'/%3e%3c/svg%3e");
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  -webkit-print-color-adjust: exact;
          color-adjust: exact;
  background-repeat: no-repeat;
  padding-top: 0.5rem;
  padding-right: 2.5rem;
  padding-bottom: 0.5rem;
  padding-left: 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  background-position: right 0.5rem center;
  background-size: 1.5em 1.5em;
}

.form-select::-ms-expand {
  color: #a0aec0;
  border: none;
}

@media not print {
  .form-select::-ms-expand {
    display: none;
  }
}

@media print and (-ms-high-contrast: active), print and (-ms-high-contrast: none) {
  .form-select {
    padding-right: 0.75rem;
  }
}
</style>
<div>

        <div class="mb-5 mt-5">
            <h1 class="text-center font-bold text-md uppercase">Creditcard  <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="absolute h-8 ml-3"></h1>
        </div>
        <div class="mb-3">
            <label class="font-bold text-sm mb-2 ml-1">E-mail</label>
            <div>
                <input wire:model="email" value="{{auth()->user()->email}}" class="w-50 px-3 py-2 mb-1 border-2 border-blue-400 bg-gray-100 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="Enter your e-mail" type="text"/>

            </div>
        </div>

 
        <div class="mb-10">
            <label  class="font-bold text-sm mb-2 ml-1">Amount</label>
            <div>
                <input wire:model="amount" class="w-50 px-3 py-2 mb-1 border-2 border-blue-200 bg-gray-100 rounded-md focus:outline-none focus:border-indigo-500 font-sm transition-colors" placeholder="Enter amount" value="10" type="text"/>

            </div>
        </div>
        <div>
            <button wire:click="paydash_link()" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold"><i class="mdi mdi-lock-outline mr-1"></i> SECURE PAY NOW</button>
        </div>                   

    </div>
</div>
