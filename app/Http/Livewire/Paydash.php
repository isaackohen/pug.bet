<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class Paydash extends Component
{

    public $user;
    public $currency;
    public $link;
    public $email;
    public $amount;

    protected $rules = [
        'amount' => 'required|min:1',
        'email' => 'required|email',
    ];


    public function mount()
    {
        $this->email = auth()->user()->email;

    }

public function paydash_link() {
    $this->validate();

    $currency = 'USD';
    $total = $this->amount;
    $email = $this->email;

    $data = array(
        "apiKey"        =>  '4fc43685-4397-4407-a23e-8c39d3619a3b',
        "email"         =>  $email,
        "amount"        =>  $total,
        "webhookURL"    =>  'https://pug.bet/api/callback/payment/paydash',
        "returnURL"     =>  'https://pug.bet/dashboard',
        "metadata"      =>  '12345',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://paydash.co.uk/api/merchant/create");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);
    $raw = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($raw);

    $redirectURL = "https://paydash.co.uk/checkout/" . $response->response;

            return redirect()->to('/payment/paydash/'.$response->response);


}



    public function render()
    {
        return view('livewire.paydash');
    }
}
