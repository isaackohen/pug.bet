<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PaymentApipurseTransactions extends User
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'payments_apipurse_transactions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'u', 'usd_amount', 'crypto_amount', 'currency',  'blockchain_txid', 'internal_id', 'from', 'to', 'status'
    ];





}