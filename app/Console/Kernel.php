<?php

namespace App\Console;

use App\Events\QueueWork;
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
                $voiceeventqueueelement->current = "starte";
                $voiceeventqueueelement->save();
                event(new QueueWork($voiceeventqueueelement->current, $voiceeventqueueelement->id));
                $voiceevent = VoiceEvent::find($voiceeventqueueelement->voiceevent_id);
                $events = $voiceevent->events()->get();
                foreach($events as $event) {
                    $voiceeventqueueelement->current = $event->name;
                    $voiceeventqueueelement->save();
                    event(new QueueWork($voiceeventqueueelement->current, $voiceeventqueueelement->id));
                    $led = $event->led()->first();
                    $duration = $event->duration;
                    $status = $event->ledStatus;
                    $gpio = $led->gpio;
                    if($status == 1) {
                        exec("python3 /home/pi/LEDApp/on.py $gpio $duration");
                    } else {
                        sleep($duration);
                    }
                }
                $voiceeventqueueelement->current = "fertig";
                $voiceeventqueueelement->save();
                event(new QueueWork($voiceeventqueueelement->current, $voiceeventqueueelement->id));
                $voiceeventqueueelement->delete();
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
