<?php

namespace App\Console\Commands;

use App\Harga;
use App\Cronjob;
use App\Kenaikan;
use Carbon\Carbon;
use App\BulanTahun;
use App\HargaAcuan;
use Illuminate\Console\Command;

class EWSCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Early Warning System';

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
        //EWS dan notif ke wa
        for ($x = 1; $x <= 10; $x++) {
            $n = new Cronjob;
            $n->cronjob = Carbon::now()->format('Y-m-d H:i:s');
            $n->save();
            $n->delay(5);
        }
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        $now = Carbon::now()->format('Y-m-d');
        $hargaToday = Harga::where('tanggal', $now)->get()->map(function ($item) use ($month, $year, $now) {
            $bulantahun_id = BulanTahun::where('bulan', $month)->where('tahun', $year)->where('pasar_id', $item->pasar_id)->first();
            dd($item);
            if ($bulantahun_id == null) {
            } else {
                $hargaAcuan = HargaAcuan::where('bulan_tahun_id', $bulantahun_id->id)->where('pasar_id', $item->pasar_id)->where('bahan_id', $item->bahan_id)->first();

                if ($hargaAcuan == null) {
                } else {
                    //jika acuan 0 kasih notif
                    if ($hargaAcuan->harga == 0) {
                        toastr()->error(' Harga Acuan Tidak Boleh 0');
                        return back();
                    } else {
                        $acuan = $hargaAcuan->harga;
                        //dd($acuan, $item->harga);
                        $kenaikan = (($item->harga - $acuan) / $acuan) * 100;
                        //dd($kenaikan, $now, $item->pasar_id, $item->bahan_id, $acuan, $item->harga);
                        //simpan jika kenaik lebih dari 5 %
                        if ($kenaikan > 5) {
                            $checkKenaikan = Kenaikan::where('tanggal', $now)->where('pasar_id', $item->pasar_id)->where('bahan_id', $item->bahan_id)->first();
                            if ($checkKenaikan == null) {
                                //new save
                                $n = new Kenaikan;
                                $n->tanggal = $now;
                                $n->pasar_id = $item->pasar_id;
                                $n->bahan_id = $item->bahan_id;
                                $n->acuan = $acuan;
                                $n->harga = $item->harga;
                                $n->kenaikan = $kenaikan;
                                $n->save();
                            } else {
                                //update
                                $u = $checkKenaikan;
                                $u->harga = $item->harga;
                                $u->kenaikan = $kenaikan;
                                $u->save();
                            }
                        } else {
                        }
                    }
                }
            }
            return $item;
        });

        // ProcessPodcast::dispatch($podcast)
        //             ->delay(now()->addMinutes(10));
        $this->info('Berhasil di simpan ' . Carbon::now()->format('Y-m-d H:i:s'));
    }
}
