<?php

namespace Portfolio\Console;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Portfolio\SocialNetwork;

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
    protected function schedule(Schedule $schedule) {
        // Запускает функцию каждый день по МСК в 3:00
        $schedule->call(function (){
            $dt = Carbon::now()->addDay(-14);

            // Удаляет из БД соц.сети
            $socials = SocialNetwork::onlyTrashed()
                ->where('deleted_at', '<', $dt)->get();
            foreach ($socials as $social){
                $social->forceDelete();
            }
        })->timezone('Europe/Moscow')->dailyAt('3:00');
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
