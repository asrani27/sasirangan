<?php

namespace App\Http\Controllers;

use App\EWS;
use App\Bahan;
use App\BulanTahun;
use App\Harga;
use App\HargaAcuan;
use App\Kenaikan;
use App\Pasar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EWSController extends Controller
{
    public function ews()
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        $now = Carbon::now()->format('Y-m-d');
        $hargaToday = Harga::where('tanggal', $now)->get()->take(5)->map(function ($item) use ($month, $year, $now) {
            $bulantahun_id = BulanTahun::where('bulan', $month)->where('tahun', $year)->where('pasar_id', $item->pasar_id)->first();
            //dd($item);
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
        toastr()->success(' Berhasil Digenerate');
        return back();
    }
}
