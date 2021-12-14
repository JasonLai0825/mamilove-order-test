<?php

namespace Mamilove\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'account',
        'amount'
    ];
}