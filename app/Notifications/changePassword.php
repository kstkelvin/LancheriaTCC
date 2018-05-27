<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Mail\ResetPassword as Mailable;

class changePassword extends Notification
{
  use Queueable;
  public $token;

  /**
  * Create a new notification instance.
  *
  * @return void
  */
  public function __construct($token)
  {
    $this->token = $token;
  }

  /**
  * Get the notification's delivery channels.
  *
  * @param  mixed  $notifiable
  * @return array
  */
  public function via($notifiable)
  {
    return ['mail'];
  }

  /**
  * Get the mail representation of the notification.
  *
  * @param  mixed  $notifiable
  * @return \Illuminate\Notifications\Messages\MailMessage
  */
  public function toMail($notifiable)
  {
    $url = env('APP_URL').'/password/reset/'.$this->token;
    $subject = sprintf("[%s] %s", config('app.name'), "Recuperação de Senha");
    return (new Mailable($this->token, $notifiable))->subject($subject)->to($notifiable->email);
  }

  /**
  * Get the array representation of the notification.
  *
  * @param  mixed  $notifiable
  * @return array
  */
  public function toArray($notifiable)
  {
    return [
      //
    ];
  }
}