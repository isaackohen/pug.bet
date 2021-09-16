<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
 
class Slotslist extends User
{

    use CrudTrait;

    use HasFactory;
      protected $connection = 'mongodb';
    protected $collection = 'slotslist';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'n',
        'desc',
        'p',
        'UID',
        'd',
        'u_id',
        'ext',
        'type'
    ];

    public static function cachedList() {
        $cachedList = Cache::get('cachedList');  

        if (!$cachedList) { 
            $cachedList = \App\Models\Slotslist::get();
            Cache::put('cachedList', $cachedList, Carbon::now()->addMinutes(10));
        } 

        return $cachedList;
    }
  
    public static function findGameName($gameid) {
        $game = DB::table('slotslist')
             ->where('_id', '=', $gameid)
             ->first();

        return $game['n'];
    }

    public static function findProvider($gameid) {
        $game = DB::table('slotslist')
             ->where('_id', '=', $gameid)
             ->first();

        return $game['p'];
    }



}