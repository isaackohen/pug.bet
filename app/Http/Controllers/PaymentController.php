<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\BalanceLog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {   
     $apipurse_storeid = 'BLiFLSwV57PGUf8wCfPJns8DgTpFVp9URgrP9jPQj8Uk';
     $apipurse_token = 'b765d914758a9fa32c1826a9ba603ea9ab965ef2';

 

 


        Log::notice($request);
        try {

        $invoice_id = $request->invoiceId;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://pay.apigamble.com/api/v1/stores/'.$apipurse_storeid.'/invoices/'.$invoice_id.'');
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

        if($request->type === 'InvoiceSettled') {
        Log::notice($result);
        }

        $decode = json_decode($result);

		$user = \App\Models\User::where('_id', '=', $decode->metadata->orderId)->first();
		$user->add(
			round($decode->amount, 2),
			"usd",
			"deposit",
			"nothing"
		);
        $invoice = new \App\Models\PaymentApipurseTransactions;
            $invoice->u = $user->_id; 
            $invoice->usdamount = round($decode->amount,2 );




			
        } catch (Exception $e) {
                return 'ok';
        }

        return 'ok';
    }

}
 