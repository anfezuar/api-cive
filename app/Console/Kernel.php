<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    protected function scheduleTimezone()
    {
        return "America/Bogota";
    }
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            DB::table('vehicles')
        ->where('vencimiento_soat', '<', date('Y-m-d'))
        ->orWhere('vencimiento_tec_mec', '<', date('Y-m-d'))
        ->orWhere('vencimiento_todo_riesgo', '<', date('Y-m-d'))
        ->orWhere('vencimiento_tarjeta_operacion', '<', date('Y-m-d'))
        ->update(['estado' => 'INACTIVO', 'razon_estado' => 'Documentos vencidos']);
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
