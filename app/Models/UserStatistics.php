<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
  use Backpack\CRUD\app\Models\Traits\CrudTrait;

class UserStatistics extends User
{
    use HasFactory;
      use CrudTrait;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }



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
        'vip_wager_tot',
        'biggest',
        'luckiest',
        'biggest_game',
        'luckiest_game'
    ];  
}

