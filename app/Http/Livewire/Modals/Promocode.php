<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
 use Carbon\Carbon;

class Promocode extends Component
{
        use Actions;

    public $code;

    protected $rules = [
        'code' => 'required|min:1',
    ];

    public function usePromocode() { 
        $this->validate();
        $code = $this->code;

        $user = auth()->user();
        if(!$user) return $this->notification()->error($title = 'Not able to redeem promocode', $description = 'You are not logged in.');

        $getPromocode = \App\Models\Promocodes::where('code', $code)->first();
        if(!$getPromocode) return $this->notification()->error($title = 'Unable to redeem promocode', $description = 'Promocode does not exist, is no longer valid or you are ineligible to use this promocode.');

        $getUserBonusHistory = \App\Models\BonusHistory::where('u', $user->_id)->first();
        $getUserPromocodeHistory = \App\Models\Promocodes_History::where('usedBy', $user->_id)->where('code', '=', $code)->first();

        if($getUserPromocodeHistory) return $this->notification()->error($title = 'Unable to redeem promocode', $description = 'You have used this promocode already previously.');

        $promocode_basevalue = $getPromocode->amount;
        $promocode_cooldown  = \App\Models\Settings::where('key', 'promocode_cooldown')->first()->value;
        $promocode_type = $getPromocode->type;

        $current_timestamp = Carbon::now()->timestamp;
        $min_timestamp = Carbon::now()->subMinute($promocode_cooldown)->timestamp;

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

        $userViplevel = auth()->user()->viplevel;

        if($getUserBonusHistory->promocode_lastused > $min_timestamp) return $this->notification()->error($title = 'Unable to redeem promocode', $description = 'You have used another promocode recently, please wait.');
        if($getPromocode->activeTill < $current_timestamp) return $this->notification()->error($title = 'Unable to redeem promocode', $description = 'This promocode has expired (time).');
        if($getPromocode->activeUsage < $getPromocode->used) return $this->notification()->error($title = 'Unable to redeem promocode', $description = 'This promocode has expired (usages).');

        $getcurrentVipInfo = \App\Models\VIP\VipLevels::where('level', '=', ($user->viplevel))->first();

        $promoVipBonus = ($promocode_basevalue / 100) * $getcurrentVipInfo->promocode_bonus;

        $endNettoPromocode = number_format(($promocode_basevalue + $promoVipBonus), 2, ".", "");

        $getUserBonusHistory->update([
                'promocode_total' => ($getUserBonusHistory->promocode_total ?? 0) + $endNettoPromocode,
                'promocode_lastused' => $current_timestamp,
                'promocode_usedtoday' => ($getUserBonusHistory->promocode_usedtoday ?? 0) + 1       
        ]);

       \App\Models\Promocodes_History::create([
            'usedBy' => $user->_id,
            'code' => $code,
            'base_amount' => $getPromocode->amount,
            'netto_amount' => $endNettoPromocode,
            'type' => $getPromocode->type

        ]);

        $user->add(
            $endNettoPromocode,
            "usd",
            "promocode",
            json_encode(["promocode" => $code, "promocode_total" => $getUserBonusHistory->promocode_total])
        );
        
        return self::notificateSuccess($user, $endNettoPromocode);
    }

        public function notificateSuccess($user, $amount)
        {
            $this->notification()->success($title = 'Success!', $description = 'Added '.$amount.'$ to your balance.');
            event(new \App\Events\PlaySound($user, "/sounds/coins.mp3"));
        }

    public function render()
    {
        return view('livewire.modals.promocode');
    }
}
