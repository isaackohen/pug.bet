<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PaymentApipurseTransactions;
use App\Models\PaymentApipurseWallets;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PaymentDepositApipurse extends Component
{
    public $user;
    public $currency;

    public $wallet = 'Generating';
    public $wallet2 = 'Generating';
    public $wallet3 = 'Generating';



    public function mount()
    {
        $uid = auth()->user()->_id;
        $this->wallet = self::findWalletAddress($uid, 'btc');
        $this->wallet2 = self::findWalletAddress($uid, 'ltc');
        $this->wallet3 = self::findWalletAddress($uid, 'doge');

    }

    public function createWallet($userid) {
        $selectuser = \App\Models\PaymentApipurseWallets::where('u', $userid)->first();

        $createinvoice = self::createInvoice($userid);
        $createinvoice = json_decode($createinvoice, true);

        $getaddresses = self::getWalletAddresses($createinvoice['id']);

        $result = json_decode($getaddresses, true);

        if(!$selectuser)

        {
            $newrow =  \App\Models\PaymentApipurseWallets::create([
    'u' =>  $userid, 'wallet_btc' => $result[0]['destination'],  'wallet_ltc' => $result[1]['destination'], 'wallet_doge' => $result[2]['destination']
]);

        } else {
        $selectuser->update([
            'wallet_btc' => $result[0]['destination'],
            'wallet_ltc' => $result[1]['destination'],
            'wallet_doge' => $result[2]['destination']
        ]);   

        }
    }


function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
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


    public static function findWalletId($gameid) {
        $game = DB::table('slotslist')
             ->where('_id', '=', $gameid)
             ->first();

        return $game['n'];
    }
 

    public function render()
    {
        return view('livewire.payment-deposit-apipurse');
    }

    public function getWalletAddresses($invoice_id) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://pay.apigamble.com/api/v1/stores/9bi269NLCM1tTA1vL8PJavkJ8HxZmMRxnJMTdXMEsFyj/invoices/'.$invoice_id.'/payment-methods');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: token 3573a436e50a61197d35ff1e9b05c3f2ac082e5f';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

            return $result;
}




    public function createInvoice($userid) {

        //Create invoice in APIPurse.com for user, valid for 24 days
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://pay.apigamble.com/api/v1/stores/9bi269NLCM1tTA1vL8PJavkJ8HxZmMRxnJMTdXMEsFyj/invoices');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"currency\":\"USD\",\"price\":0,\"orderId\":\"$userid\",\"buyer\":{\"email\":\"john@doe.com\"},\"token\":\"MqA2wX15qHCbG7FBtJZRAxQunrRjAvGBRVJedsiTnZY\", \"metadata\": {\n\"orderId\": \"$userid\"\n}}");

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: token 3573a436e50a61197d35ff1e9b05c3f2ac082e5f';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

            return $result;

}


}
