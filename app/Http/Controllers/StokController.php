<?php

namespace App\Http\Controllers;

use App\Stok;
use App\Bahan;
use App\Pasar;
use App\Stok_kota;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class StokController extends Controller
{

    public function index()
    {
        $pasar = Pasar::get();
        return view('admin.stok.index', compact('pasar'));
    }
    public function index2()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $week = Carbon::now()->weekOfMonth;


        $data = Bahan::orderBy('id', 'DESC')->get()->map(function ($item) use ($month, $year) {
            $item->stok_kota = $item->stok_kota->where('bulan', $month)->where('tahun', $year);
            return $item;
        });

        $fullmonth = false;
        return view('admin.stok.stok', compact('data', 'month', 'year', 'fullmonth', 'week'));
    }

    public function pasar($id)
    {
        $pasar = Pasar::find($id);
        $bahan = $pasar->bahan;
        $week = Carbon::now()->weekOfMonth;

        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();
        $date = CarbonPeriod::create($start, $end)->toArray();


        $data = $bahan->map(function ($item) use ($month, $id, $year) {
            $check = Stok_kota::where('bulan', $month)->where('tahun', $year)->where('bahan_id', $item->id)->where('pasar_id', $id)->first();
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

        $fullmonth = false;
        return view('admin.stok.stok', compact('data', 'pasar', 'date', 'month', 'year', 'fullmonth', 'week', 'id'));
    }

    public function updateService(Request $req)
    {
        //return $req->all();
        $check = Stok_kota::where('bahan_id', $req->pk)->where('bulan', $req->bulan)->where('tahun', $req->tahun)->where('pasar_id', $req->pasar_id)->first();
        if ($check == null) {
            $s = new Stok_kota;
            $s->bulan = $req->bulan;
            $s->tahun = $req->tahun;
            $s->bahan_id = $req->pk;
            $s->pasar_id = $req->pasar_id;
            if ($req->minggu == '1') {
                $s->minggu_1 = $req->value;
            } elseif ($req->minggu == '2') {
                $s->minggu_2 = $req->value;
            } elseif ($req->minggu == '3') {
                $s->minggu_3 = $req->value;
            } elseif ($req->minggu == '4') {
                $s->minggu_4 = $req->value;
            } elseif ($req->minggu == '5') {
                $s->minggu_5 = $req->value;
            }
            $s->save();
            return 'di simpan';
        } else {
            $s = $check;
            if ($req->minggu == '1') {
                $s->minggu_1 = $req->value;
            } elseif ($req->minggu == '2') {
                $s->minggu_2 = $req->value;
            } elseif ($req->minggu == '3') {
                $s->minggu_3 = $req->value;
            } elseif ($req->minggu == '4') {
                $s->minggu_4 = $req->value;
            } elseif ($req->minggu == '5') {
                $s->minggu_5 = $req->value;
            }
            $s->save();
            return 'di update';
        }
    }
    public function month($id)
    {

        $pasar = Pasar::find($id);
        $bahan = $pasar->bahan;

        $month     = request()->get('bulan');
        $year      = request()->get('tahun');
        $daysCount = Carbon::parse($month . '/01/' . $year)->daysInMonth;
        $week      =  Carbon::parse($month . '/' . $daysCount . '/' . $year)->weekOfMonth;

        $data = $bahan->map(function ($item) use ($month, $year, $id) {
            $check = Stok_kota::where('bulan', $month)->where('tahun', $year)->where('bahan_id', $item->id)->where('pasar_id', $id)->first();
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


        // $data = Stok_kota::where('bulan', (int)$month)->where('tahun', $year)->get()->map(function($item)use($month, $year){
        //     $item->stok_kota = $item->stok_kota->where('bulan', $month)->where('tahun', $year);
        //     return $item;
        // });
        $fullmonth = true;
        return view('admin.stok.stok', compact('data', 'month', 'year', 'fullmonth', 'week', 'id', 'pasar'));
    }
}
