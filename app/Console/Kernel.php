<?php

namespace App\Console;

use App\Models\Loan;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // Default Open loan
            Loan::where('status','Open')
            ->where('maturity_date','<=',now())
            ->where('balance','>',0)
            ->update([
                'status' => 'Defaulted'
            ]);

            // Default Restructured loan
            Loan::where('status','Restructured')
            ->where('maturity_date','<=',now())
            ->where('balance','>',0)
            ->update([
                'status' => 'Defaulted'
            ]);

            // Close Open Loan
            Loan::where('status','Open')
            ->where('maturity_date','<=',now())
            ->where('balance','<=',0)
            ->update([
                'status' => 'Closed'
            ]);

            // Close Restructured Loan
            Loan::where('status','Restructured')
            ->where('maturity_date','<=',now())
            ->where('balance','<=',0)
            ->update([
                'status' => 'Closed'
            ]);

            // Close Defaulted Loan
            Loan::where('status','Defaulted')
            ->where('maturity_date','<=',now())
            ->where('balance','<=',0)
            ->update([
                'status' => 'Closed'
            ]);
        })->daily();
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

    /**
     * Get the timezone that should be used by default for scheduled events.
     * 
     * @return \DateTimeZone|string|null
     */
    protected function scheduleTimezone()
    {
        return 'Africa/Kampala';
    }
}
