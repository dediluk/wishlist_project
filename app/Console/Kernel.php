<?php

namespace App\Console;

use App\Models\Wish;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('app:test-command')->everyMinute();
//        $schedule->call(function () {
////            DB::table('wishes')->orderBy('created_at', 'desc')->first()->update(['title' => 'Schedule task at ' . now()]);
//            $wish = Wish::latest('created_at')->first();
//            $wish->title = 'Schedule task at ' . now();
//            $wish->save();
//        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
