<?php

namespace App\Http\Controllers;

use App\EWS;
use App\Stok;
use App\Bahan;
use App\Harga;
use App\Pasar;
use App\Berita;
use App\Slider;
use App\Kenaikan;
use Carbon\Carbon;
use App\NomorAduan;
use App\Stok_kota;
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
            $aduan = NomorAduan::first();
            return view('frontend.beranda', compact('berita', 'slider', 'aduan'));
        }
    }

    public function kenaikan()
    {
        $ews = Kenaikan::where('tanggal', Carbon::now()->format('Y-m-d'))->get();
        $aduan = NomorAduan::first();
        return view('frontend.kenaikan', compact('ews', 'aduan'));
    }
    public function detailArtikel($id)
    {
        $berita = Berita::find($id);
        $aduan = NomorAduan::first();
        return view('frontend.detail', compact('berita', 'aduan'));
    }
    public function info_harga()
    {
        $data = [];
        $pasar = Pasar::get();
        $aduan = NomorAduan::first();
        return view('frontend.info_harga', compact('data', 'aduan', 'pasar'));
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
        $aduan = NomorAduan::first();
        return view('frontend.info_harga', compact('data', 'pasar', 'aduan', 'pasar_id', 'tanggal'));
    }

    public function info_stok()
    {
        $data = [];
        $pasar = Pasar::where('tampil_stok', 'Y')->get();
        $aduan = NomorAduan::first();

        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        return view('frontend.info_stok', compact('data', 'aduan', 'pasar', 'month', 'year'));
    }

    public function info_stok_search()
    {
        $pasar_id = request()->get('pasar_id');
        $month = request()->get('bulan');
        $year = request()->get('tahun');

        $daysCount = Carbon::parse($month . '/01/' . $year)->daysInMonth;
        $week      =  Carbon::parse($month . '/' . $daysCount . '/' . $year)->weekOfMonth;
        $bahan = Pasar::find($pasar_id)->bahan;
        $data = $bahan->map(function ($item) use ($pasar_id, $month, $year) {
            $check = Stok_kota::where('bulan', $month)->where('tahun', $year)->where('bahan_id', $item->id)->where('pasar_id', $pasar_id)->first();
            if ($check == null) {
                $item->minggu_1 = 0;
                $item->minggu_2 = 0;
                $item->minggu_3 = 0;
                $item->minggu_4 = 0;
                $item->minggu_5 = 0;
            } else {
                $item->minggu_1 = $check->minggu_1;
                $item->minggu_2 = $check->minggu_2;
                $item->minggu_3 = $check->minggu_3;
                $item->minggu_4 = $check->minggu_4;
                $item->minggu_5 = $check->minggu_5;
            }

            return $item;
        });

        $pasar = Pasar::where('tampil_stok', 'Y')->get();
        $aduan = NomorAduan::first();
        return view('frontend.info_stok', compact('data', 'pasar', 'aduan', 'pasar_id', 'month', 'year', 'week'));
    }

    public function grafik_harga()
    {
        $data = [];
        $pasar = Pasar::get();
        $bahan = Bahan::get();
        $aduan = NomorAduan::first();
        return view('frontend.grafik_harga', compact('data', 'pasar', 'aduan', 'bahan'));
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
        $aduan = NomorAduan::first();
        return view('frontend.grafik_harga', compact('data', 'pasar', 'aduan', 'pasar_id', 'bulan', 'tahun', 'bahan', 'bahan_id', 'dataset'));
    }

    public function grafik_stok()
    {
        $data = [];
        $pasar = Pasar::get();
        $aduan = NomorAduan::first();
        return view('frontend.grafik_stok', compact('data', 'pasar', 'aduan'));
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
        $aduan = NomorAduan::first();
        return view('frontend.grafik_stok', compact('data', 'pasar', 'pasar_id', 'tahun', 'aduan'));
    }

    public function login()
    {
        $aduan = NomorAduan::first();
        return view('frontend.login', compact('aduan'));
    }

    public function artikel()
    {
        $aduan = NomorAduan::first();
        $berita = Berita::orderBy('id', 'DESC')->paginate(5);
        return view('frontend.artikel', compact('berita', 'aduan'));
    }
}
