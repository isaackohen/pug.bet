<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Promocodes extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'promocodes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'code', 'activeTill', 'activeUsage', 'amount', 'type', 'used'
    ];
}