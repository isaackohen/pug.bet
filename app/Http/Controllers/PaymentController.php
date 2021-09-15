<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\BalanceLog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Events\UserNotification;
class PaymentController extends Controller
{
    public function callback(Request $request)
    {

    $apipurse_storeid = 'BLiFLSwV57PGUf8wCfPJns8DgTpFVp9URgrP9jPQj8Uk';
    $apipurse_token = 'b765d914758a9fa32c1826a9ba603ea9ab965ef2';

        //Log::notice($request);

        $invoice_id = $request->invoiceId;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://apipurse.com/api/v1/stores/'.$apipurse_storeid.'/invoices/'.$invoice_id.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: token '.$apipurse_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch))
        {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        //Log::notice($result);
        $decode = json_decode($result);

        $user = \App\Models\User::where('_id', '=', $decode->metadata->orderId)->first();
        
        \App\Models\PaymentApipurseWallets::where('u', $user->_id)->delete();

        if($request->type === 'InvoiceReceivedPayment')
        {
            event(new \App\Events\PlaySound($user, "/sounds/notify.mp3"));
            event(new \App\Events\UserNotification($user, "Payment Notification", "Crypto payment appeared on blockchain, waiting for confirmation.", "info"));
        }

        if($request->type === 'InvoiceSettled')
        {
            $amount_format = number_format($decode->amount, 2, ".", "");
            event(new \App\Events\PlaySound($user, "/sounds/coins.mp3"));
            event(new \App\Events\UserNotification($user, "Payment Notification", "Deposit confirmed, added ".$amount_format."$ to your balance", "success"));
           
    		$user->add(
    			$amount_format,
    			"usd",
    			"deposit",
    			$decode->id
    		);

           \App\Models\Invoices::create([
                'invoice_id' => $decode->id,
                'u' => $user->_id,
                'type' => 'btcpayserver',
                'usd' => $amount_format
            ]);

            return 'ok';
        }
    }


    public function offertoroPage(Request $request)
    {
        $offertoro_account = \App\Models\Settings::where('key', 'offertoro_account_id')->first()->value;
        $offertoro_app = \App\Models\Settings::where('key', 'offertoro_app_id')->first()->value;
        return view('offertoro-page')->with('account_id', $offertoro_account)->with('app_id', $offertoro_app);   
    }

    public function offertoroCallback(Request $request)
    {
            //Log::notice($request);
            $offerToroApikey = \App\Models\Settings::where('key', 'offertoro_apikey')->first()->value;
            $user = \App\Models\User::where('_id', $request->user_id)->first();
            $amount_format = $request->amount;
            $invoice_id = $request->oid;
            $md5sign = $request->sig;
            $md5 = md5($invoice_id."-".$request->user_id."-".$offerToroApikey);

            //Log::notice('md5hash_generated: '.$md5.' md5hash_sentwithcallback: '.$md5);

            if($md5sign === $md5)
            {
                $invoiceExist = \App\Models\Invoices::where('invoice_id', $md5sign)->first();
                if(!$invoiceExist) 
                {
                    $user->add(
                        $amount_format,
                        "usd",
                        "offertoro",
                        $md5sign
                    );
                   \App\Models\Invoices::create([
                        'invoice_id' => $md5sign,
                        'u' => $user->_id,
                        'type' => 'offertoro',
                        'usd' => $amount_format
                    ]);
                }

            //Return to say we received callback
            return '1';

            } else
            {
                //Return to say we received callback
                return '1';
            }
    }
}
 
