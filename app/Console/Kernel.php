<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /* $schedule->call(function () {
            Log::info("Scheduler testing");
        })->everyMinute(); */

        // send reminder sms to clients before 24 hour of clinical session
        $schedule->call('\App\Services\SmsService@clinicalSessionReminderBefore24Hour')
            ->hourly()
            ->description('session reminder for client before 24 hour');

        if (env('TELESCOPE_ENABLED', false)) {
            // delete all telescope entries older than 72 hours
            $schedule->command('telescope:prune --hours=72')->daily();
        }
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
