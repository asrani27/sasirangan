<?php

namespace App\Http\Controllers;

use App\EWS;
use App\Bahan;
use App\Harga;
use App\Pasar;
use App\Kenaikan;
use Carbon\Carbon;
use App\BulanTahun;
use App\HargaAcuan;
use App\Notifikasi;
use App\Jobs\SendNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EWSController extends Controller
{
    public function ews()
    {
        //delete data sebelumnya 
        Kenaikan::where('tanggal', Carbon::now()->format('Y-m-d'))->delete();

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        $now = Carbon::now()->format('Y-m-d');
        $hargaToday = Harga::where('tanggal', $now)->get()->map(function ($item) use ($month, $year, $now) {
            $bulantahun_id = BulanTahun::where('bulan', $month)->where('tahun', $year)->where('pasar_id', $item->pasar_id)->first();
            //dd($item);
            if ($bulantahun_id == null) {
            } else {
                $hargaAcuan = HargaAcuan::where('bulan_tahun_id', $bulantahun_id->id)->where('pasar_id', $item->pasar_id)->where('bahan_id', $item->bahan_id)->first();

                if ($hargaAcuan == null) {
                } else {
                    //jika acuan 0 kasih notif
                    if ($hargaAcuan->harga == 0) {
                        toastr()->error(' Harga Acuan Tidak Boleh 0, Pasar : ' . $hargaAcuan->pasar->nama);
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

        // if (Kenaikan::where('tanggal', Carbon::now()->format('Y-m-d'))->count() != 0) {
        //     dispatch(new SendNotif)->delay(now()->addSeconds(10));
        // }
        $nomor = Notifikasi::get();
        foreach ($nomor as $key => $item) {
            dd($item);
        }
        $pesan = [
            "phoneNumber" => $nomor,
            "content" => [
                "text" => Carbon::now()->translatedFormat('d F Y') .
                    " \nEarly Warning system (EWS), \n Harga Bahan Pokok Yang mengalami Kenaikan : \n Link : https://dedikasibaiman.banjarmasinkota.go.id/kenaikan \n",
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjhlMTE4NmUzLWJkZTEtNDhlYi05MzAxLTY1ZGQ5MzIzNjdiNiIsImlhdCI6MTY4NjI3MjY3M30.KvyD0cCvAQNFC8V4e0ZsZ3eR4M6nKZeC5JCov_yhHXI',
        ])->withBody(json_encode($pesan), 'application/json')->post('https://api.wa.banjarmasinkota.go.id/whatsapp/8e1186e3-bde1-48eb-9301-65dd932367b6/messages');

        toastr()->success(' Berhasil Digenerate');
        return back();
    }
}
