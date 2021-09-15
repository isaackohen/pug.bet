<x-modal wire:model.defer="jackpotInfo">
    <x-card title="Jackpot Info">
        <div>
            <p>The current Jackpot is at <span class="text-primary font-semibold">{{$jackpot_sum}}$</span>. You automatically have a chance to win Jackpot on every bet above {{$jackpot_min}}$.</p>
            <br>
            <p>
            Every bet, {{$jackpot_contribution}}% of the wager, is contributed in-to the prizepot.
            </p>
            <br>
            <p>Chance to win Jackpot as as following:
            <br>
            (({{$jackpot_chance}}% + vipBonusChance) * usd_wager_amount)</p>

            <br>
        </div>   
      </x-card>
</x-modal>
  