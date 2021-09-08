<?php

namespace App\Http\Livewire\Modals;
use WireUi\Traits\Actions;
use Livewire\Component;

class Wallet extends Component
{
    use Actions;


        public function mount()
    {

        $uid = auth()->user()->_id;
        $this->wallet = self::findWalletAddress($uid, 'btc');
        $this->wallet2 = self::findWalletAddress($uid, 'ltc');
        $this->wallet3 = self::findWalletAddress($uid, 'doge');
        $this->wallet4 = self::findWalletAddress($uid, 'btg');

    }

public function bitcoingold() {

        $this->dialog()->confirm([
            'title'       => 'Your BITCOINGOLD Address',
            'description' =>  self::findWalletAddress(auth()->user()->_id, 'btg'),
            'acceptLabel' => 'Ok',
            'click'      => 'copyDoge()'
        ]);
}

public function litecoin() {

        $this->dialog()->confirm([
            'title'       => 'Your LITECOIN Address',
            'description' =>  self::findWalletAddress(auth()->user()->_id, 'ltc'),
            'acceptLabel' => 'Ok',
            'click'      => 'copyDoge()'
        ]);
}


public function bitcoin() {

        $this->dialog()->confirm([
            'title'       => 'Your BITCOIN Address',
            'description' =>  self::findWalletAddress(auth()->user()->_id, 'btc'),
            'acceptLabel' => 'Ok',
            'click'      => 'copyDoge()'
        ]);
}

public function dogecoin() {

        $this->dialog()->confirm([
            'title'       => 'Your DOGE Address',
            'description' =>  self::findWalletAddress(auth()->user()->_id, 'doge'),
            'acceptLabel' => 'Copy Address',
            'click'      => 'copyDoge()'
        ]);
}

    public function render()
    {
        return view('livewire.modals.wallet');
    }

  public function findWalletAddress($userid, $currency) {
        $selectuser = \App\Models\PaymentApipurseWallets::where('u', $userid)->first();



        if(!$selectuser) {


            $generatewallet = self::createWallet($userid);
        }
 
        $definewallet = 'wallet_'.$currency;
        $getwallet = \App\Models\PaymentApipurseWallets::where('u', $userid)->where($definewallet, '!=', null)->first();
        $getwallet = $getwallet->$definewallet;
        if(!$getwallet || $getwallet === 'error' || $getwallet === null) {
            $generatewallet = self::createWallet($userid, $currency);
        }
        $wallet = $getwallet;



        return $getwallet;
    }

}
