<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\changePassword;

class User extends Authenticatable
{
  use Notifiable;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name', 'surname', 'password', 'email', 'is_admin', 'has_account'
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

  public function sendPasswordResetNotification($token)
  {
    $this->notify(new changePassword($token));
  }

}
