<?php

namespace App\Http\Controllers;

use App\EWS;
use App\Bahan;
use App\Harga;
use App\Pasar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EWSController extends Controller
{
    public function ews()
    {
        $to = Carbon::now()->format('Y-m-d');
        $from = Carbon::now()->subDay(3)->format('Y-m-d');
        $pasar = Pasar::get()->map->only(['id', 'nama']);

        foreach ($pasar as $key => $ps) {

            $bahan = Bahan::get()->map(function ($item) use ($to, $from, $ps) {
                $item->pasar = $ps['nama'];
                $item->batas = $item->batas;
                $item->acuan = $item->acuan;
                $item->tanggal = Harga::where('bahan_id', $item->id)->where('pasar_id', $ps['id'])->whereBetween('tanggal', [$from, $to])->get()->map->only(['tanggal', 'harga']);
                // //dd($item->tanggal[0]['tanggal']);
                $item->kenaikan = $item->tanggal->where('harga', '<', $item->batas)->count() != 0 ? 'T' : 'Y';

                // //dd($item->kenaikan);
                if ($item->kenaikan == 'Y') {
                    $checkEWS = EWS::where('tanggal', $to)->where('pasar_id', $ps['id'])->where('bahan_id', $item->id)->first();
                    //dd($item->tanggal);
                    if ($checkEWS == null) {
                        //save
                        $n = new EWS;
                        $n->tanggal = $to;
                        $n->pasar_id = $ps['id'];
                        $n->bahan_id = $item->id;
                        $n->batas = $item->batas;
                        $n->acuan = $item->acuan;
                        $n->h1 = $item->tanggal[3]['harga'];
                        $n->h2 = $item->tanggal[2]['harga'];
                        $n->h3 = $item->tanggal[1]['harga'];
                        $n->h4 = $item->tanggal[0]['harga'];
                        $n->kesimpulan = 'naik';
                        $n->save();
                    } else {
                        //update
                        $n = $checkEWS;
                        $n->batas = $item->batas;
                        $n->acuan = $item->acuan;
                        $n->h1 = $item->tanggal[3]['harga'];
                        $n->h2 = $item->tanggal[2]['harga'];
                        $n->h3 = $item->tanggal[1]['harga'];
                        $n->h4 = $item->tanggal[0]['harga'];
                        $n->kesimpulan = 'naik';
                        $n->save();
                    }
                }


                return $item->only(['pasar', 'nama', 'batas', 'acuan', 'tanggal', 'kenaikan']);
            });
        }
        toastr()->success(' Berhasil Di Hitung');
        return back();
    }
}
