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
      //  $schedule->command('subscribe_free')->hourly();
        $schedule->command('subscribe_free')->dailyAt('08:00');
        $schedule->command('subscribe_free')->dailyAt('09:00');
        $schedule->command('subscribe_free')->dailyAt('10:00');
        $schedule->command('subscribe_free')->dailyAt('11:00');
        $schedule->command('subscribe_free')->dailyAt('12:00');
        $schedule->command('subscribe_free')->dailyAt('13:00');
        $schedule->command('subscribe_free')->dailyAt('14:00');

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
