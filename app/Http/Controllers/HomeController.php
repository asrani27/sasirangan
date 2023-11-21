<?php

namespace App\Http\Controllers;

use App\EWS;
use App\Pasar;
use App\Traffic;
use App\Kenaikan;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $period = CarbonPeriod::create(Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->lastOfMonth()->format('Y-m-d'));

        $data = [];
        foreach ($period as $date) {
            $data[] = [
                'tanggal' => $date->format('Y-m-d'),
                'value' => Traffic::where('tanggal', $date->format('Y-m-d'))->count(),
            ];
        }

        $pasar = Pasar::count();
        $tahun2021 = Traffic::whereYear('tanggal', 2021)->get()->count();
        $tahun2022 = Traffic::whereYear('tanggal', 2022)->get()->count();
        $tahun2023 = Traffic::whereYear('tanggal', 2023)->get()->count();
        $totalPengunjung = Traffic::count();
        $pengunjungHariIni = Traffic::where('tanggal', Carbon::now()->format('Y-m-d'))->count();

        $ews = Kenaikan::where('tanggal', Carbon::now()->format('Y-m-d'))->get();

        return view('admin.home', compact('data', 'pasar', 'tahun2021', 'pengunjungHariIni', 'totalPengunjung', 'ews'));
    }
}
