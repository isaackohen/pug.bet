<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Slotslist extends User
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '_id',
        'n',
        'desc',
        'p',
        'UID',
        'd',
        'u_id',
    ];


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