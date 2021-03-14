<?php

namespace App\Http\Controllers;

use App\Bahan;
use App\Pasar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function harian()
    {
        $today = Carbon::today()->format('Y-m-d');
        $data = Bahan::get()->map(function($item)use($today){
            $bahan_id = $item->id;
            $item->pasar = $item->pasar->map(function($p) use ($bahan_id, $today){
                $hargaToday = $p->hargaToday->where('bahan_id', $bahan_id)->where('tanggal', $today)->first();
                $p->hargaToday = $hargaToday == null ? 0 : $hargaToday->harga;
                return $p;
            });
            return $item;
        });
        
        $pasar = Pasar::get();
        $tanggal = Carbon::today()->format('Y-m-d');
        
        return view('admin.report.harian',compact('data','pasar','tanggal'));
    }

    public function searchHarian()
    {
        $tanggal = request()->get('tanggal');
        
        $data = Bahan::get()->map(function($item)use($tanggal){
            $bahan_id = $item->id;
            $item->pasar = $item->pasar->map(function($p) use ($bahan_id, $tanggal){
                $p->hargaToday = $p->hargaToday->where('bahan_id', $bahan_id)->where('tanggal', $tanggal)->first();
                return $p;
            });
            return $item;
        });
        
        $pasar = Pasar::get();
        toastr()->success('Data Tanggal '.Carbon::parse($tanggal)->format('d M Y').' ditampilkan');
        
        return view('admin.report.harian',compact('data','pasar','tanggal'));
    }
    
    public function bulanan()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $data = Bahan::get()->map(function($item){
            $bahan_id = $item->id;
            $item->pasar = $item->pasar->map(function($p) use ($bahan_id){
                $subMonth = Carbon::today()->subMonth()->endOfMonth()->format('Y-m-d');
                $today = Carbon::today()->format('Y-m-d');
                $hargaLalu = $p->bulanLalu->where('bahan_id', $bahan_id)->where('tanggal', $subMonth)->first();
                $hargaKini = $p->hargaToday->where('bahan_id', $bahan_id)->where('tanggal', $today)->first();
                $p->bulanLalu = $hargaLalu == null ? 0 : $hargaLalu->harga;
                $p->bulanIni = $hargaKini == null ? 0 : $hargaKini->harga;
                return $p;
            });
            $item->bulanLalu = ceil($item->pasar->sum('bulanLalu') / count($item->pasar));
            $item->bulanIni = ceil($item->pasar->sum('bulanIni') / count($item->pasar));
            if($item->bulanLalu == $item->bulanIni){
                $item->perubahan = 0;
            }elseif($item->bulanLalu > $item->bulanIni){
                $item->perubahan = $item->bulanIni - $item->bulanLalu;
            }elseif($item->bulanLalu < $item->bulanIni){
                $item->perubahan = $item->bulanIni - $item->bulanLalu;
            }
            return $item;
        });
        //dd($month, $year, $data);
        return view('admin.report.bulanan',compact('month', 'year','data'));
    }
    
    public function stok()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        return view('admin.report.bulanan',compact('month', 'year'));
    }

    public function searchBulanan()
    {

        $month = request()->get('bulan');
        $year = request()->get('tahun');
        $data = Bahan::get()->map(function($item)use( $month, $year){
            $bahan_id = $item->id;
            $item->pasar = $item->pasar->map(function($p) use ($bahan_id, $month, $year){
                $subMonth = Carbon::createFromFormat('m/Y', $month.'/'.$year)->subMonth()->endOfMonth()->format('Y-m-d');


                $thisMonth = Carbon::today()->format('m-Y');
                if($thisMonth == $month.'-'.$year){
                    $today = Carbon::today()->format('Y-m-d');
                }else{
                    $today =Carbon::createFromFormat('m/Y', $month.'/'.$year)->endOfMonth()->format('Y-m-d');
                }
                
                $hargaLalu = $p->bulanLalu->where('bahan_id', $bahan_id)->where('tanggal', $subMonth)->first();
                $hargaKini = $p->hargaToday->where('bahan_id', $bahan_id)->where('tanggal', $today)->first();
                $p->bulanLalu = $hargaLalu == null ? 0 : $hargaLalu->harga;
                $p->bulanIni = $hargaKini == null ? 0 : $hargaKini->harga;
                return $p;
            });
            $item->bulanLalu = ceil($item->pasar->sum('bulanLalu') / count($item->pasar));
            $item->bulanIni = ceil($item->pasar->sum('bulanIni') / count($item->pasar));
            if($item->bulanLalu == $item->bulanIni){
                $item->perubahan = 0;
            }elseif($item->bulanLalu > $item->bulanIni){
                $item->perubahan = $item->bulanIni - $item->bulanLalu;
            }elseif($item->bulanLalu < $item->bulanIni){
                $item->perubahan = $item->bulanIni - $item->bulanLalu;
            }
            return $item;
        });
        
        return view('admin.report.bulanan',compact('month', 'year','data'));
    }
}
