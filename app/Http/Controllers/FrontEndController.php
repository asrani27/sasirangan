<?php

namespace App\Http\Controllers;

use App\Bahan;
use App\Harga;
use App\Pasar;
use App\Berita;
use App\Slider;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    public function beranda()
    {
        if (Auth::check()) {
            return redirect('/home');
        } else {
            $berita = Berita::orderBy('id', 'DESC')->limit(4)->get();
            $slider = Slider::orderBy('id', 'DESC')->get();
            return view('frontend.beranda', compact('berita', 'slider'));
        }
    }

    public function detailArtikel($id)
    {
        $berita = Berita::find($id);
        return view('frontend.detail', compact('berita'));
    }
    public function info_harga()
    {
        $data = [];
        $pasar = Pasar::get();
        return view('frontend.info_harga', compact('data', 'pasar'));
    }

    public function info_harga_search()
    {
        $pasar_id = request()->get('pasar_id');
        $tanggal = request()->get('tanggal');
        $tanggal_sekarang = Carbon::parse($tanggal);
        $tanggal_kemarin = Carbon::parse($tanggal)->subDay();

        $bahan = Pasar::find($pasar_id)->bahan;
        //dd($bahan, $pasar_id);
        $data = $bahan->map(function ($item) use ($tanggal_sekarang, $tanggal_kemarin, $pasar_id) {
            $item->harga_terkini = Harga::where('bahan_id', $item->id)->where('tanggal', $tanggal_sekarang->format('Y-m-d'))->where('pasar_id', $pasar_id)->first();
            $item->harga_kemarin = Harga::where('bahan_id', $item->id)->where('tanggal', $tanggal_kemarin->format('Y-m-d'))->where('pasar_id', $pasar_id)->first();
            if ($item->harga_terkini == null) {
                $item->harga_terkini = 0;
            } else {
                $item->harga_terkini = $item->harga_terkini->harga;
            }
            if ($item->harga_kemarin == null) {
                $item->harga_kemarin = 0;
            } else {
                $item->harga_kemarin = $item->harga_kemarin->harga;
            }

            if ($item->harga_terkini == $item->harga_kemarin) {
                $item->perubahan = 0;
            } elseif ($item->harga_terkini > $item->harga_kemarin) {
                $item->perubahan = $item->harga_terkini - $item->harga_kemarin;
            } elseif ($item->harga_terkini < $item->harga_kemarin) {
                $item->perubahan = $item->harga_terkini - $item->harga_kemarin;
            }
            return $item;
        });

        $pasar = Pasar::get();
        return view('frontend.info_harga', compact('data', 'pasar', 'pasar_id', 'tanggal'));
    }

    public function info_stok()
    {
        $data = [];
        $pasar = Pasar::get();
        return view('frontend.info_stok', compact('data', 'pasar'));
    }

    public function info_stok_search()
    {
        $pasar_id = request()->get('pasar_id');
        $tanggal = request()->get('tanggal');
        $tanggal_sekarang = Carbon::parse($tanggal);
        $bulan_lalu = Carbon::parse($tanggal)->subMonth()->endOfMonth();

        $bahan = Pasar::find($pasar_id)->bahan;
        $data = $bahan->map(function ($item) use ($tanggal_sekarang, $bulan_lalu, $pasar_id) {
            $item->stok_terkini = $item->stok->where('tanggal', $tanggal_sekarang->format('Y-m-d'))->where('pasar_id', $pasar_id)->first();
            $item->bulan_lalu = $item->stok->where('tanggal', $bulan_lalu->format('Y-m-d'))->where('pasar_id', $pasar_id)->first();

            if ($item->stok_terkini == null) {
                $item->stok_terkini = 0;
            } else {
                $item->stok_terkini = $item->stok_terkini->stok;
            }
            if ($item->bulan_lalu == null) {
                $item->bulan_lalu = 0;
            } else {
                $item->bulan_lalu = $item->bulan_lalu->stok;
            }

            if ($item->stok_terkini == $item->bulan_lalu) {
                $item->perubahan = 0;
            } elseif ($item->stok_terkini > $item->bulan_lalu) {
                $item->perubahan = $item->stok_terkini - $item->bulan_lalu;
            } elseif ($item->stok_terkini < $item->bulan_lalu) {
                $item->perubahan = $item->stok_terkini - $item->bulan_lalu;
            }

            // if($item->bulan_lalu == 0){
            //     $item->persen = 100;
            // }elseif($item->stok_terkini - $item->bulan_lalu == 0){
            //     $item->persen = 0;
            // }else{
            //     ($item->terkini / $item->bulan_lalu) * 100 -100;
            // }
            return $item;
        });
        //        dd($data);
        $pasar = Pasar::get();
        return view('frontend.info_stok', compact('data', 'pasar', 'pasar_id', 'tanggal'));
    }

    public function grafik_harga()
    {
        $data = [];
        $pasar = Pasar::get();
        $bahan = Bahan::get();
        return view('frontend.grafik_harga', compact('data', 'pasar', 'bahan'));
    }

    public function grafik_harga_search()
    {
        $pasar_id   = request()->get('pasar_id');
        $bulan      = request()->get('bulan');
        $tahun      = request()->get('tahun');
        $bahan_id   = request()->get('bahan_id');
        $start      = Carbon::createFromFormat('m-Y', $bulan . '-' . $tahun)->startOfMonth();
        $end        = Carbon::createFromFormat('m-Y', $bulan . '-' . $tahun)->endOfMonth();

        $date = CarbonPeriod::create($start, $end);

        foreach ($date as $d) {
            $dates[] = $d->format('Y-m-d');
        }

        $data['tanggal'] = $dates;

        $graph = Harga::where('pasar_id', $pasar_id)->where('bahan_id', $bahan_id)
            ->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();

        $rgbColor = array();
        foreach (array('r', 'g', 'b') as $color) {
            $rgbColor[$color] = mt_rand(0, 255);
        }

        foreach ($dates as $item) {
            $dataAngka[] = $graph->where('tanggal', $item)->first() == null ? 0 : $graph->where('tanggal', $item)->first()->harga;
        }

        $dataset[] = [
            'label' => Bahan::find($bahan_id)->nama,
            'fill' => false,
            'data' => $dataAngka,
            'borderColor' => [
                'rgba(' . $rgbColor['r'] . ', ' . $rgbColor['g'] . ', ' . $rgbColor['b'] . ')'
            ],
            'borderWidth' => 2,
        ];

        $bahan = Bahan::get();

        $pasar = Pasar::get();
        return view('frontend.grafik_harga', compact('data', 'pasar', 'pasar_id', 'bulan', 'tahun', 'bahan', 'bahan_id', 'dataset'));
    }

    public function grafik_stok()
    {
        $data = [];
        $pasar = Pasar::get();
        return view('frontend.grafik_stok', compact('data', 'pasar'));
    }

    public function grafik_stok_search()
    {
        $pasar_id = request()->get('pasar_id');
        //$bulan = request()->get('bulan');
        $tahun = request()->get('tahun');
        // $start = Carbon::createFromFormat('m-Y', $bulan.'-'.$tahun)->startOfMonth();
        // $end = Carbon::createFromFormat('m-Y', $bulan.'-'.$tahun)->endOfMonth();

        // $date = CarbonPeriod::create($start, $end);
        // $dates = [];
        // foreach($date as $d){
        //     $dates[] = $d->format('Y-m-d');
        // }

        // $data['tanggal'] = $dates;

        $pasar = Pasar::get();
        $data = [
            'name' => 'asrani',
        ];
        //dd($data);
        return view('frontend.grafik_stok', compact('data', 'pasar', 'pasar_id', 'tahun'));
    }

    public function login()
    {
        return view('frontend.login');
    }

    public function artikel()
    {
        $berita = Berita::orderBy('id', 'DESC')->paginate(5);
        return view('frontend.artikel', compact('berita'));
    }
}
