<?php

namespace App\Console;

use App\Harga;
use App\Pasar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
            DB::beginTransaction();
            try{
                $tglKemarin = Carbon::today()->subDay(1)->format('Y-m-d');
                $tglSekarang = Carbon::today()->format('Y-m-d');
                $pasar_id = Pasar::get()->pluck('id');
                foreach($pasar_id as $pasar){
                    $dataCronJob = Harga::where('pasar_id', $pasar)->where('tanggal', $tglKemarin)->get();
                    foreach($dataCronJob as $item)
                    {
                        $check = Harga::where('tanggal', $tglSekarang)->where('pasar_id', $item->pasar_id)->where('bahan_id', $item->bahan_id)->first();
                        
                        if($check == null){
                            //simpan data
                            $n = new Harga;
                            $n->tanggal  = $tglSekarang;
                            $n->harga    = $item->harga;
                            $n->pasar_id = $item->pasar_id;
                            $n->bahan_id = $item->bahan_id;
                            $n->save();
            
                        }else{
                        }
                    }
                }
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
            }
        });
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
