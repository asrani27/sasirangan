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
        // $to = Carbon::now()->format('Y-m-d');
        // $from = Carbon::now()->subDay(3)->format('Y-m-d');
        // $pasar = Pasar::get()->map->only(['id', 'nama']);

        // foreach ($pasar as $key => $ps) {

        //     $bahan = Bahan::get()->map(function ($item) use ($to, $from, $ps) {
        //         $item->pasar = $ps['nama'];
        //         $item->batas = $item->batas;
        //         $item->acuan = $item->acuan;
        //         $item->tanggal = Harga::where('bahan_id', $item->id)->where('pasar_id', $ps['id'])->whereBetween('tanggal', [$from, $to])->get()->map->only(['tanggal', 'harga']);
        //         // //dd($item->tanggal[0]['tanggal']);
        //         $item->kenaikan = $item->tanggal->where('harga', '<', $item->batas)->count() != 0 ? 'T' : 'Y';

        //         // //dd($item->kenaikan);
        //         if ($item->kenaikan == 'Y') {
        //             $checkEWS = EWS::where('tanggal', $to)->where('pasar_id', $ps['id'])->where('bahan_id', $item->id)->first();
        //             //dd($item->tanggal);
        //             if ($checkEWS == null) {
        //                 //save
        //                 $n = new EWS;
        //                 $n->tanggal = $to;
        //                 $n->pasar_id = $ps['id'];
        //                 $n->bahan_id = $item->id;
        //                 $n->batas = $item->batas;
        //                 $n->acuan = $item->acuan;
        //                 $n->h1 = $item->tanggal[3]['harga'];
        //                 $n->h2 = $item->tanggal[2]['harga'];
        //                 $n->h3 = $item->tanggal[1]['harga'];
        //                 $n->h4 = $item->tanggal[0]['harga'];
        //                 $n->kesimpulan = 'naik';
        //                 $n->save();
        //             } else {
        //                 //update
        //                 $n = $checkEWS;
        //                 $n->batas = $item->batas;
        //                 $n->acuan = $item->acuan;
        //                 $n->h1 = $item->tanggal[3]['harga'];
        //                 $n->h2 = $item->tanggal[2]['harga'];
        //                 $n->h3 = $item->tanggal[1]['harga'];
        //                 $n->h4 = $item->tanggal[0]['harga'];
        //                 $n->kesimpulan = 'naik';
        //                 $n->save();
        //             }
        //         }


        //         return $item->only(['pasar', 'nama', 'batas', 'acuan', 'tanggal', 'kenaikan']);
        //     });
        // }
        // toastr()->success(' Berhasil Di Hitung');
        // return back();
    }
}
