<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Invoices extends Model
{
    use HasFactory;
    use CrudTrait;
    protected $connection = 'mongodb';
    protected $collection = 'invoices';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
public function openUser($crud = false)
{
    return '<a class="btn btn-sm btn-link" target="_blank" href="/admin/users/'.urlencode($this->u).'/edit" data-toggle="tooltip" title="View Player"><i class="fa fa-search"></i> Deposited by Player</a>';
}

    protected $fillable = [
       'invoice_id', 'u', 'type', 'usd', 'crypto_amount'
    ];
}