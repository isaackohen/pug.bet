<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Invoices extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'invoices';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
       'invoice_id', 'u', 'type', 'usd', 'crypto_amount'
    ];
}