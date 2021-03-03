<?php

namespace App\Http\Controllers;

use App\Stok;
use App\Pasar;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $pasar = Pasar::get();
        return view('admin.stok.index',compact('pasar'));
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
        $pasar_id = $req->pasar;
        $bahan_id = $req->pk;
        $tgl = Carbon::today()->format('Y-m-d');
        $find = Stok::where('tanggal', $tgl)->where('bahan_id', $bahan_id)->where('pasar_id', $pasar_id)->first();
        if($find != null){
            $find->stok = $req->value;
            $find->save();
        }else{
            $f = new Stok;
            $f->tanggal = $tgl;
            $f->stok = $req->value;
            $f->pasar_id = $pasar_id;
            $f->bahan_id = $bahan_id;
            $f->save();
        }
        return 'ok';
    }
}
