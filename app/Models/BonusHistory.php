<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BonusHistory extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'user_bonushistory';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'u', 'faucet_total', 'faucet_lastused', 'promocode_total', 'promocode_lastused', 'promocode_freespins', 'promocode_usedtoday'
    ];
}