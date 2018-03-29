<?php

namespace App\Console;
use Illuminate\Support\Facades\Config;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
  /**
  * The Artisan commands provided by your application.
  *
  * @var array
  */
  protected $commands = [
    'App\Console\Commands\MailSender'
  ];

  /**
  * Define the application's command schedule.
  *
  * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
  * @return void
  */
  protected function schedule(Schedule $schedule)
  {
    $schedule->command('php artisan send:mail')
    ->timezone('America/Sao_Paulo')
    ->dailyAt('18:50');
  }

  /**
  * Register the commands for the application.
  *
  * @return void
  */
  protected function commands()
  {
    $this->load(__DIR__.'/Commands');

    require base_path('routes/console.php');
  }
}
