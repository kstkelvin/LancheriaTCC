<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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

      //\Cron::add('send-the-effing-mail', '* * * * *', function() {
      //echo "Running Task";
      //  Artisan::call('email:debt');
      //}, true);

      \Cron::add('send-this', '* * * * *', function() {
        echo "testing";
      }, true);

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
