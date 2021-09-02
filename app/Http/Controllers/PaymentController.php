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

        Log::notice($request);
        try {

        $invoice_id = $request->invoiceId;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://pay.apigamble.com/api/v1/stores/9bi269NLCM1tTA1vL8PJavkJ8HxZmMRxnJMTdXMEsFyj/invoices/'.$invoice_id.'');
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
			
        } catch (Exception $e) {
                return 'ok';
        }

        return 'ok';
    }

}
 