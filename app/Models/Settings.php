<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Settings extends User
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'key', 'value'
    ];
}