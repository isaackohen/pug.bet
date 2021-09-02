<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PaymentApipurseSettings extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'payments_apipurse_settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'setting', 'value', 'extra'
    ];





}