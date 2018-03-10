<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'username', 'name', 'surname', 'password', 'is_admin', 'has_account'
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password', 'remember_token', 'is_admin'
  ];

  public function client()
  {
    return $this->hasOne(Client::class);
  }

  public function isAdmin()
  {
    return $this->is_admin;
  }
}
