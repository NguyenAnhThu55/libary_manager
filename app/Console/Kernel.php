<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\BorrowBooks as BorrowBooks;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
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
        //kiểm tra hạn 
       $schedule->command('post:cron')->at('6:58');
        // kiểm tra mỗi ngày vào lúc 7h sáng
        $schedule->command('email:send')->at('7:00');
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
