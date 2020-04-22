<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //for the daily digest being sent out daily

        'App\Console\Commands\RegisteredUsers',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('registered:users')
            ->dailyAt('23:50')
            ->sendOutputTo(
                storage_path(
                    'logs/' .
                        Carbon::now()->format('Y-m-d') .
                        '-registered:users-output.txt'
                )
            );
        $schedule->command('comments:users')
            ->everyFifteenMinutes()
            ->sendOutputTo(
                storage_path(
                    'logs/' .
                    Carbon::now()->format('Y-m-d') .
                    '-comments:users-output.txt'
                )
            );
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        //require base_path('routes/console.php');

        $this->load(__DIR__ . '/Commands');
    }
}
