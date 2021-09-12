<?php

    namespace App\Http\Livewire\Modals;
    use WireUi\Traits\Actions;
    use Livewire\Component;
use App\Models\PaymentApipurseTransactions;
use App\Models\PaymentApipurseWallets;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Wallet extends Component
{
    public $wallet2;
    use Actions;

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function mount()
    {
        $uid = auth()->user()->_id;
        $this->wallet = self::findWalletAddress($uid, 'btc');
        $this->wallet2 = self::findWalletAddress($uid, 'ltc');
        $this->wallet3 = self::findWalletAddress($uid, 'doge');
        $this->wallet4 = self::findWalletAddress($uid, 'btg');
    }

    public function createWallet($userid) {
        $selectuser = \App\Models\PaymentApipurseWallets::where('u', $userid)->first();
        $createinvoice = self::createInvoice($userid); 
        $createinvoice = json_decode($createinvoice, true);
        $getaddresses = self::getWalletAddresses($createinvoice['id']);
        $result = json_decode($getaddresses, true);

        if(!$selectuser)

        {
        $newrow =  \App\Models\PaymentApipurseWallets::create(['u' =>  $userid, 'wallet_btc' => $result[0]['destination'],  'wallet_ltc' => $result[1]['destination'], 'wallet_doge' => $result[2]['destination'], 'wallet_btg' => $result[3]['destination']]);

        } else {
        $selectuser->update([
            'wallet_btc' => $result[0]['destination'],
            'wallet_ltc' => $result[1]['destination'],
            'wallet_doge' => $result[2]['destination'],
            'wallet_btg' => $result[3]['destination']
        ]);   
        }
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

    public function getWalletAddresses($invoice_id) {
     $apipurse_storeid = 'BLiFLSwV57PGUf8wCfPJns8DgTpFVp9URgrP9jPQj8Uk';
     $apipurse_token = 'b765d914758a9fa32c1826a9ba603ea9ab965ef2';

        $url = 'https://apipurse.com/api/v1/stores/'.$apipurse_storeid.'/invoices/'.$invoice_id.'/payment-methods';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: token '.$apipurse_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        //Log::warning($result);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

            return $result;
    }

    public function createInvoice($userid) {
    //Create invoice in APIPurse.com for user, valid for 24 days
    $ch = curl_init();

     $apipurse_storeid = 'BLiFLSwV57PGUf8wCfPJns8DgTpFVp9URgrP9jPQj8Uk';
     $apipurse_token = 'b765d914758a9fa32c1826a9ba603ea9ab965ef2';

        curl_setopt($ch, CURLOPT_URL, 'https://apipurse.com/api/v1/stores/'.$apipurse_storeid.'/invoices');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"currency\":\"USD\",\"orderId\":\"$userid\",\"buyer\":{\"email\":\"john@doe.com\"},\"token\":\"EBBlCB7o7bhPrrdinY0i0B77WUo01GL1hvZ1voORb70\", \"metadata\": {\n\"orderId\": \"$userid\"\n}}");

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: token '.$apipurse_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    public function render()
    {
        return view('livewire.modals.wallet');
    }
}
