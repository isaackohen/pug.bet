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
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        //Log::notice($result);
        $decode = json_decode($result);

        $user = \App\Models\User::where('_id', '=', $decode->metadata->orderId)->first();
        
        \App\Models\PaymentApipurseWallets::where('u', $user->_id)->delete();

        if($request->type === 'InvoiceReceivedPayment'){
            event(new \App\Events\PlaySound($user, "/sounds/notify.mp3"));
            event(new \App\Events\UserNotification($user, "Payment Notification", "Crypto payment appeared on blockchain, waiting for confirmation.", "info"));
        }

        if($request->type === 'InvoiceSettled') {
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
}
 
