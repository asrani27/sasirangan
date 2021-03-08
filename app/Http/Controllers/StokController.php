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
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $data = Bahan::orderBy('id','DESC')->get()->map(function($item)use($month, $year){
            $item->stok_kota = $item->stok_kota->where('bulan', $month)->where('tahun', $year);
            return $item;
        });
        
        
        return view('admin.stok.stok',compact('data','month','year'));
    }
    
    public function pasar($id)
    {
        $pasar = Pasar::find($id);
        $bahan = $pasar->bahan;
        
        $month = Carbon::today();
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();
        $date = CarbonPeriod::create($start, $end)->toArray();

        $data = $bahan->map(function($item)use($month,$id){
            $check = Stok::where('tanggal', $month->format('Y-m-d'))->where('bahan_id', $item->id)->where('pasar_id', $id)->first();
            if($check == null){
                $item->stok = 0;
            }else{
                $item->stok = $check->stok;
            }
            return $item;
        });
        
        
        return view('admin.stok.stok',compact('data', 'pasar','date', 'month'));
    }

    public function updateService(Request $req)
    {
        $check = Stok_kota::where('bahan_id',$req->pk)->where('bulan', $req->bulan)->where('tahun', $req->tahun)->first();
        if($check == null){
            $s = new Stok_kota;
            $s->bulan = $req->bulan;
            $s->tahun = $req->tahun;
            $s->bahan_id = $req->pk;
            if($req->minggu == '1'){
                $s->minggu_1 = $req->value;
            }elseif($req->minggu == '2'){
                $s->minggu_2 = $req->value;
            }elseif($req->minggu == '3'){
                $s->minggu_3 = $req->value;
            }elseif($req->minggu == '4'){
                $s->minggu_4 = $req->value;
            }
            $s->save();
            return 'di simpan';
        }else{
            $s = $check;
            if($req->minggu == '1'){
                $s->minggu_1 = $req->value;
            }elseif($req->minggu == '2'){
                $s->minggu_2 = $req->value;
            }elseif($req->minggu == '3'){
                $s->minggu_3 = $req->value;
            }elseif($req->minggu == '4'){
                $s->minggu_4 = $req->value;
            }
            $s->save();
            return 'di update';
        }
    }
}
