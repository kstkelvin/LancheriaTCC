<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;

class AppServiceProvider extends ServiceProvider
{
  /**
  * Bootstrap any application services.
  *
  * @return void
  */
  public function boot()
  {
    // Please note the different namespace
    // and please add a \ in front of your classes in the global namespace
    \Event::listen('cron.collectJobs', function() {
      \Cron::setDisablePreventOverlapping();
      \Cron::add('send-the-effing-mail', '* * * * *', function() {
        echo "Running Task";
        Artisan::call('schedule:run');
      }, true);
      \Cron::setLogger(new \Monolog\Logger('cronLogger'));
      // One job will be called
      $report = \Cron::run();


      //\Cron::add('send-this', '* * * * *', function() {
      //echo "testing";
      //}, true);

    });

  }

  /**
  * Register any application services.
  *
  * @return void
  */
  public function register()
  {
    //
  }
}
