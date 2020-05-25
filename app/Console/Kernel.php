<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\VoiceEventQueue;
use App\VoiceEvent;

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
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            if(sizeof(VoiceEventQueue::all()) > 0) {
                $voiceeventqueueelement = VoiceEventQueue::first();
                $voiceevent = VoiceEvent::find($voiceeventqueueelement->voiceevent_id);
                $events = $voiceevent->events()->get();
                foreach($events as $event) {
                    $led = $event->led();
                    $duration = $event->duration;
                    $status = $event->ledStatus;
                    $gpio = $led->gpio;
                    exec("gpio -1 mode $gpio out");
                    exec("gpio -1 write $gpio $status");
                    sleep($duration);
                }
                foreach ($events as $event) {
                    $led = $event->led();
                    $gpio = $led->gpio;
                    exec("gpio -1 mode $gpio out");
                    exec("gpio -1 write $gpio 0");
                }
            }
        })->everyMinute();
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
