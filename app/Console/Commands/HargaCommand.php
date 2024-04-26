<?php

namespace App\Console\Commands;

use App\Harga;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HargaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'perbaikanharga {--tanggal=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perbaikan harga 0';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tanggal = $this->option('tanggal');
        $tglKemarin = Carbon::parse($this->option('tanggal'))->subDay(1)->format('Y-m-d');
        $data = Harga::where('tanggal', $tanggal)->get();
        foreach ($data as $key => $i) {
            $hargasebelumnya = Harga::where('tanggal', $tglKemarin)->where('bahan_id', $i->bahan_id)->where('pasar_id', $i->pasar_id)->first()->harga;
            $i->update(['harga' => $hargasebelumnya]);
        }
        return 'ok';
    }
}
