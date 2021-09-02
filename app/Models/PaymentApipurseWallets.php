<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PaymentApipurseWallets extends User
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'payments_apipurse_wallets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'u', 'wallet_btc', 'wallet_ltc', 'wallet_btg', 'wallet_xmr', 'wallet_doge'
    ];





}