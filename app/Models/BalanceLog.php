<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
  
class BalanceLog extends User
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
        'add',
        'subtract',
        'bal',
        'curr',
        'meta',
        'internal',
        'data'
    ];
}

