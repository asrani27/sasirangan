<?php

namespace App\Http\Controllers;

use App\Bahan;
use App\Harga;
use App\Pasar;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    public function index()
    {
        $pasar = Pasar::get();
        return view('admin.harga.index',compact('pasar'));
    }
    
    public function fullDate($id)
    {
        $pasar = Pasar::find($id);
        $bulan = request()->get('bulan');
        $tahun = request()->get('tahun');
        $start = Carbon::CreateFromFormat('d-m-Y', '01-'.$bulan.'-'.$tahun)->startOfMonth();
        $end = Carbon::CreateFromFormat('d-m-Y', '01-'.$bulan.'-'.$tahun)->endOfMonth();
        $date = CarbonPeriod::create($start, $end)->toArray();
        $hargaMonth = Harga::where('tanggal', 'like', '%'.$tahun.'-'.$bulan.'%')->get();
        $data = Bahan::get()->map(function($item)use($date, $hargaMonth, $id){
            $item->tanggal = collect($date)->map(function($d)use($hargaMonth, $id, $item){
                    $check = $hargaMonth->where('tanggal', $d->format('Y-m-d'))->where('bahan_id', $item->id)->where('pasar_id', $id)->first();
                    if($check == null){
                        $h = 0;
                    }else{
                        $h = $check->harga;
                    }
                    return $h;
                });         
            return $item;
        });
        $fulldate = true;
        
        return view('admin.harga.harga',compact('data', 'pasar','date', 'month','fulldate','bulan','tahun','start'));
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
            $check = Harga::where('tanggal', $month->format('Y-m-d'))->where('bahan_id', $item->id)->where('pasar_id', $id)->first();
            if($check == null){
                $item->harga = 0;
            }else{
                $item->harga = $check->harga;
            }
            return $item;
        });
        
        $fulldate = false;
        
        return view('admin.harga.harga',compact('data', 'pasar','date', 'month', 'fulldate'));
    }

    public function updateService(Request $req)
    {
        $pasar_id = $req->pasar;
        $bahan_id = $req->pk;
        $tgl = $req->tanggal;
        $find = Harga::where('tanggal', $tgl)->where('bahan_id', $bahan_id)->where('pasar_id', $pasar_id)->first();
        if($find != null){
            $find->harga = $req->value;
            $find->save();
        }else{
            $f = new Harga;
            $f->tanggal = $tgl;
            $f->harga = $req->value;
            $f->pasar_id = $pasar_id;
            $f->bahan_id = $bahan_id;
            $f->save();
        }
        return 'ok';
    }
}
