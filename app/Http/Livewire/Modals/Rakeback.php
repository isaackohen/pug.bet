<?php

namespace App\Http\Livewire\Modals;


use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
 use Carbon\Carbon;

class Rakeback extends Component
{
    use Actions;

    public function useRakeback() { 
        $user = auth()->user();

        if(!$user) return $this->notification()->error($title = 'Not able to redeem faucet', $description = 'You are not logged in.');

        $getUserBonusHistory = \App\Models\BonusHistory::where('u', $user->_id)->first();

        $rakeback_cooldown = \App\Models\Settings::where('key', 'rakeback_cooldown')->first()->value;

        $current_timestamp = Carbon::now()->timestamp;
        $min_timestamp = Carbon::now()->subMinute($rakeback_cooldown)->timestamp;



        if(!$getUserBonusHistory) {
           \App\Models\BonusHistory::create([
                'u' => $user->_id, 
                'freespins_initiated' => 0,
                'rakeback_lastused' => 0,
                'rakeback_total' => 0,
                'faucet_total' => 0,
                'faucet_lastused' => 0,
                'promocode_total' => 0,
                'promocode_freespins' => 0,
                'promocode_usedtoday' => 0,
                'promocode_lastused' => 0
            ]);
            
            $getUserBonusHistory = \App\Models\BonusHistory::where('u', $user->_id)->first();
        }

        $rakebackMinimum = \App\Models\Settings::where('key', 'rakeback_minimum')->first()->value;

        $userViplevel = auth()->user()->viplevel;
        $rakebackValue = (auth()->user()->rake / 100);

        if($rakebackValue < $rakebackMinimum) return $this->notification()->error($title = 'Not able to redeem rake', $description = 'You need to have built up more then '.$rakebackMinimum.'$ before redeeming rake.');


        if($getUserBonusHistory->rakeback_lastused > $min_timestamp) {
            $timeEndConvert = Carbon::createFromTimestamp($getUserBonusHistory->rakeback_lastused)->addMinutes($rakeback_cooldown)->toDateTimeString();
            $timeLeft = Carbon::now()->diffInMinutes($timeEndConvert);

            return $this->notification()->error($title = 'Not able to redeem faucet', $description = 'You have redeemed rakeback recently. Wait '.$timeLeft.' minutes before using again.');
        }
        
        //Let's add extra rakeback bonuses later
        $rakebackBonus = 0;

        $endNettoRakeback =  number_format(($rakebackValue + $rakebackBonus), 2, ".", "");

        $getUserBonusHistory->update([
                'rakeback_total' => ($getUserBonusHistory->rakeback_total ?? 0) + $endNettoRakeback,
                'rakeback_lastused' => $current_timestamp
        ]);

        $user->update(['rake' => 0]);

        $user->add(
            $endNettoRakeback,
            "usd",
            "rakeback",
            json_encode(["rakeback" => $rakebackValue, "rakeback_total" => $getUserBonusHistory->faucet_total])
        );

        event(new \App\Events\PlaySound($user, "/sounds/coins.mp3"));
        return $this->notification()->success($title = 'Success!', $description = 'Added '.$endNettoRakeback.'$ rake to your balance.');
    }

    public function render()
    {
        return view('livewire.modals.rakeback');
    }
}
