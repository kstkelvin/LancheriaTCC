<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['client_id', 'product_id', 'amount', 'is_paid', 'total'];

    public function product(){
      return $this->belongsTo(Client::class, 'foreign_key');
    }
    public function client(){
      return $this->belongsTo(Client::class, 'foreign_key');
    }
}
