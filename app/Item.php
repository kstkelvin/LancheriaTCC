<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['product_id', 'client_id', 'amount', 'paid?'];
}
