<?php

namespace App\Console;

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
        \App\Console\Commands\Free::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {



        // send today content
       // $schedule->command('subscribe_free')->dailyAt('08:00');
       /*
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('08:00'); // 10 am
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('09:00'); // 11 am
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('10:00'); // 12 pm
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('11:00');
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('12:00');
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('13:00');
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('14:00');
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('15:00');
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('16:00');
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('17:00');
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('18:00');
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('19:00');
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('20:00');
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('21:00');
       $schedule->call('App\Http\Controllers\OrangeController@orange_send_today_content')->dailyAt('22:00'); //  10  pm
       */

      // daily deduction message
      /*
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('08:15');
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('09:15');
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('10:15');
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('11:15');
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('12:15');
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('13:15');
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('14:15');
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('15:15');
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('16:15');
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('17:15');
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('18:15');
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('19:15');
      $schedule->call('App\Http\Controllers\OrangeController@orange_send_daily_deduction')->dailyAt('20:15');
      */


       // weekly deduction message  // weekly at 11 at monday
     //  $schedule->call('App\Http\Controllers\OrangeController@orange_send_weekly_deduction')->weeklyOn(1, '9:00');;


        // send  charging to orange
        $schedule->command('subscribe_free')->dailyAt('09:00');
        $schedule->command('subscribe_free')->dailyAt('10:00');
        $schedule->command('subscribe_free')->dailyAt('11:00');
        $schedule->command('subscribe_free')->dailyAt('12:00');
        $schedule->command('subscribe_free')->dailyAt('13:00');
        $schedule->command('subscribe_free')->dailyAt('14:00');
        $schedule->command('subscribe_free')->dailyAt('15:00');
        $schedule->command('subscribe_free')->dailyAt('16:00');
        $schedule->command('subscribe_free')->dailyAt('17:00');
        $schedule->command('subscribe_free')->dailyAt('18:00');
        $schedule->command('subscribe_free')->dailyAt('19:00');
        $schedule->command('subscribe_free')->dailyAt('20:00');
        $schedule->command('subscribe_free')->dailyAt('21:00');
       $schedule->command('subscribe_free')->dailyAt('22:49');
       $schedule->command('subscribe_free')->dailyAt('23:00');

       $schedule->command('subscriber:lifecount')->dailyAt('01:00');



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
