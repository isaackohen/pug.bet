<div class="container mx-auto px-4 sm:px-8">
    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal livefeed">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Game
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Player
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Bet
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Win
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\GameHistory::orderBy('_id', 'desc')->get()->take($rowlength) as $game)
                        
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-full h-full rounded-full shadow-inne"
                                        src="https://cdn.apigamble.com/i/long/jpg/{{$game->gameid}}.jpg?width=30"
                                        alt="" />
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap font-semibold text-blue-600">
                                            <a @auth href="/slots/real/{{$game->gameid}}" @else href="/slots/demo/{{$game->gameid}}" @endauth>
                                            {{ \App\Models\Slotslist::findGameName($game->gameid)}}</a>
                                            <br>
                                            <span class="text-gray-600 text-xs font-medium whitespace-no-wrap">{{ \App\Models\Slotslist::findProvider($game->gameid)}}</span>
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="cursor-pointer text-gray-900 whitespace-no-wrap font-semibold text-blue-600" wire:click=showUser('{{ $game->u }}')>{{ \App\Models\User::findUsername($game->u)}}</p>
                            </td>  


                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ number_format($game['bet'] / 100, 2)}}$
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($game['bet'] < $game['win'])
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    @else
                                    <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                        @endif
                                        
                                        <span class="relative">{{ number_format($game['win'] / 100, 2)}}$</span>
                                    </span>
                                </td>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div x-data>
    <span x-show="$wire.showMessage">...</span>
 
    <button x-on:click="$wire.toggleShowMessage()">...</button>
</div>