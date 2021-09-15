<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Blog extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'blogs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'title', 'body',
    ];
}