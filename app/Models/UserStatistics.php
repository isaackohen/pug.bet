<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
  
class UserStatistics extends User
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '_id',
        'u',
        'usd_wager',
        'usd_win',
        'usd_games',
        'vip_wager',
        'biggest',
        'luckiest',
        'biggest_game',
        'luckiest_game'
    ];  
}

