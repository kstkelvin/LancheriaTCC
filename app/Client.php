<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  //timestamps = false impede o Laravel de criar um timestamp.
  //solução provisória. fillables são as representações dos campos que serão
  //preenchidos nos formulários e encaminhados para o banco de dados. o id
  //não consta pois ele é automaticamente incrementado pelo Eloquent do Laravel.
  public $timestamps = false;
  protected $fillable = ['name', 'surname', 'setor', 'phone_number', 'total'];

  public function item(){
    return $this->hasMany(Item::class);
  }


  public function user()
  {
    return $this->belongsTo(User::class);
  }

}
