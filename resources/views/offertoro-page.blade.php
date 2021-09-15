<x-app-layout>

<div class="container mx-auto px-3 sm:px-y-3">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @auth

        <iframe src="https://www.offertoro.com/ifr/show/{{$account_id}}/{{auth()->user()->_id}}/{{$app_id}}" frameborder="0" width="100%" style="min-height: 85vh;" ></iframe> 
        @else

        <p>You need to be logged in to complete Offertoro surveys.
        @endauth

        </div>
    </div>
</div> 
</x-app-layout>