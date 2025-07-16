<?php

namespace App\Console\Commands;

use App\Harga;
use App\Cronjob;
use App\Kenaikan;
use Carbon\Carbon;
use App\BulanTahun;
use App\HargaAcuan;
use App\Notifikasi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        $now = Carbon::now()->format('Y-m-d');
        $hargaToday = Harga::where('tanggal', $now)->get()->map(function ($item) use ($month, $year, $now) {
            $bulantahun_id = BulanTahun::where('bulan', $month)->where('tahun', $year)->where('pasar_id', $item->pasar_id)->first();

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

        $n = new Cronjob;
        $n->cronjob = Carbon::now()->format('Y-m-d H:i:s');
        $n->save();

        if (Kenaikan::where('tanggal', Carbon::now()->format('Y-m-d'))->count() != 0) {

            $nomor = Notifikasi::get();
            foreach ($nomor as $key => $item) {

                $pesan = [
                    "sendTo" => $item['nomor'],
                    "content" => [
                        "text" => Carbon::now()->translatedFormat('d F Y') .
                            " \nEarly Warning system (EWS), \n Harga Bahan Pokok Yang mengalami Kenaikan : \n Link : https://dedikasi.banjarmasinkota.go.id/kenaikan \n",
                    ]
                ];

                Http::withHeaders([
                    'Authorization' => 'Bearer IjF-1UCnC-Vf0iOkYU568oKL0YY_FET7tSCmh5VsnIZeuB6Pyy9_QvP0Uc5z0Z7amQG8s6uTecVSS1czxgBcF2IzQxfROxsgHHtGnRH1bjVXUpPuuZX8C9KkB8GsJFFZ0_R3qsLntIhfdR_V-RlFo-rCI2U9sjDk-Q5QqI6pe_efBaEGAx4ZuCp6sCAIIhO29grFy2gkTwbd0ZLJabhM4UPLKJihkrvebmhGR3e6BOrWBEsEqIni11yFNSOZnhbG5Hwy0S84kgah03QGo9pLEhw3HTR4tLQ8VWy2EMn_6u6QwF6jnTln8I_ddFCgn4cvkvPmh464cEzUUvHbIlRuow',
                ])->withBody(json_encode($pesan), 'application/json')->post('https://whatsapp.banjarmasinkota.go.id/api/service/send');

                sleep(5);
            }
        }
        $this->info('Berhasil di simpan ' . Carbon::now()->format('Y-m-d H:i:s'));
    }
}
