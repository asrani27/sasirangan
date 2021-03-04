<?php

namespace App\Http\Controllers;

use App\Pasar;
use App\Berita;
use App\Slider;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function beranda()
    {
        $berita = Berita::orderBy('id','DESC')->limit(4)->get();
        $slider = Slider::orderBy('id', 'DESC')->get();
        return view('frontend.beranda',compact('berita','slider'));
    }

    public function info_harga()
    {
        $data = [];
        $pasar = Pasar::get();
        return view('frontend.info_harga',compact('data','pasar'));
    }
    
    public function info_harga_search()
    {
        $pasar_id = request()->get('pasar_id');
        $tanggal = request()->get('tanggal');
        $tanggal_sekarang = Carbon::parse($tanggal);
        $tanggal_kemarin = Carbon::parse($tanggal)->subDay();
        
        $bahan = Pasar::find($pasar_id)->bahan;
        $data = $bahan->map(function($item)use($tanggal_sekarang, $tanggal_kemarin, $pasar_id){
            $item->harga_terkini = $item->harga->where('tanggal', $tanggal_sekarang->format('Y-m-d'))->where('pasar_id', $pasar_id)->first();
            $item->harga_kemarin = $item->harga->where('tanggal', $tanggal_kemarin->format('Y-m-d'))->where('pasar_id', $pasar_id)->first();
            if($item->harga_terkini == null){
                $item->harga_terkini = 0;
            }else{
                $item->harga_terkini = $item->harga_terkini->harga;
            }
            if($item->harga_kemarin == null){
                $item->harga_kemarin = 0;
            }else{
                $item->harga_kemarin = $item->harga_kemarin->harga;
            }

            if($item->harga_terkini == $item->harga_kemarin){
                $item->perubahan = 0;
            }elseif($item->harga_terkini > $item->harga_kemarin){
                $item->perubahan = $item->harga_terkini - $item->harga_kemarin;
            }elseif($item->harga_terkini < $item->harga_kemarin){
                $item->perubahan = $item->harga_terkini - $item->harga_kemarin;
            }
            return $item;
        });
        
        $pasar = Pasar::get();
        return view('frontend.info_harga',compact('data','pasar','pasar_id', 'tanggal'));
    }

    public function info_stok()
    {
        $data = [];
        $pasar = Pasar::get();
        return view('frontend.info_stok',compact('data','pasar'));
    }

    public function info_stok_search()
    {
        $pasar_id = request()->get('pasar_id');
        $tanggal = request()->get('tanggal');
        $tanggal_sekarang = Carbon::parse($tanggal);
        $bulan_lalu = Carbon::parse($tanggal)->subMonth()->endOfMonth();
        
        $bahan = Pasar::find($pasar_id)->bahan;
        $data = $bahan->map(function($item)use($tanggal_sekarang, $bulan_lalu, $pasar_id){
            $item->stok_terkini = $item->stok->where('tanggal', $tanggal_sekarang->format('Y-m-d'))->where('pasar_id', $pasar_id)->first();
            $item->bulan_lalu = $item->stok->where('tanggal', $bulan_lalu->format('Y-m-d'))->where('pasar_id', $pasar_id)->first();
            
            if($item->stok_terkini == null){
                $item->stok_terkini = 0;
            }else{
                $item->stok_terkini = $item->stok_terkini->stok;
            }
            if($item->bulan_lalu == null){
                $item->bulan_lalu = 0;
            }else{
                $item->bulan_lalu = $item->bulan_lalu->stok;
            }

            if($item->stok_terkini == $item->bulan_lalu){
                $item->perubahan = 0;
            }elseif($item->stok_terkini > $item->bulan_lalu){
                $item->perubahan = $item->stok_terkini - $item->bulan_lalu;
            }elseif($item->stok_terkini < $item->bulan_lalu){
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
        return view('frontend.info_stok',compact('data','pasar','pasar_id', 'tanggal'));
    }

    public function grafik_harga()
    {
        $data = [];
        $pasar = Pasar::get();
        return view('frontend.grafik_harga',compact('data','pasar'));
    }
    
    public function grafik_harga_search()
    {
        $pasar_id = request()->get('pasar_id');
        $bulan = request()->get('bulan');
        $tahun = request()->get('tahun');
        $start = Carbon::createFromFormat('m-Y', $bulan.'-'.$tahun)->startOfMonth();
        $end = Carbon::createFromFormat('m-Y', $bulan.'-'.$tahun)->endOfMonth();
        
        $date = CarbonPeriod::create($start, $end);
        $dates = [];
        foreach($date as $d){
            $dates[] = $d->format('Y-m-d');
        }

        $data['tanggal'] = $dates;
        return $data;
        dd($pasar_id, $bulan, $tahun, $data['tanggal']);
        $pasar = Pasar::get();
        return view('frontend.grafik_harga',compact('data','pasar','allDate'));
    }

    public function grafik_stok()
    {
        $data = [];
        $pasar = Pasar::get();
        return view('frontend.grafik_stok',compact('data','pasar'));
    }

    public function login()
    {
        return view('frontend.login');
    }
}
