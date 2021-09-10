<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Promocodes_History extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'promocodes_history';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'code', 'usedBy', 'base_amount', 'netto_amount', 'type'
    ];
}