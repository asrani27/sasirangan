<?php

namespace App\Http\Controllers;

use App\Bahan;
use App\Harga;
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
        
        // $data = Bahan::get()->map(function($item)use($tanggal){
        //     $bahan_id = $item->id;
        //     $item->pasar = $item->pasar->map(function($p) use ($bahan_id, $tanggal){
        //         $p->hargaToday = $p->hargaToday->where('bahan_id', $bahan_id)->where('tanggal', $tanggal)->first();
        //         return $p;
        //     });
        //     return $item;
        // });

        $data = Bahan::get()->map(function($item)use($tanggal){
            $bahan_id = $item->id;
            $item->pasar = $item->pasar->map(function($p) use ($bahan_id, $tanggal){
                $harga = Harga::where('pasar_id', $p->id)->where('tanggal', $tanggal)->where('bahan_id', $bahan_id)->first();
                $p->hargaToday = $harga == null ? 0 : $harga->harga;
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
        $week = Carbon::now()->weekOfMonth;
        $bulanLalu = Carbon::createFromFormat('m-Y', $month.'-'.$year)->subMonth();
        $bl = $bulanLalu->month;
        $tl = $bulanLalu->year;
        
        $data = Bahan::get()->map(function($item)use($month, $year, $week, $bl, $tl){
            $stok_terkini = $item->stok_kota->where('bulan', $month)->where('tahun', $year)->first();
            $stok_bulanlalu = $item->stok_kota->where('bulan', $bl)->where('tahun', $tl)->first();
            $item->stok_terkini = $stok_terkini == null ? 0 : $stok_terkini->toArray()['minggu_'.$week];
            $item->stok_bulanlalu = $stok_bulanlalu == null ? 0 : $stok_bulanlalu->toArray()['minggu_4'];
            
            if($item->stok_bulanlalu == $item->stok_terkini){
                $item->perubahan = 0;
            }elseif($item->stok_bulanlalu > $item->stok_terkini){
                $item->perubahan = $item->stok_terkini - $item->stok_bulanlalu;
            }elseif($item->bulanLalu < $item->stok_terkini){
                $item->perubahan = $item->stok_terkini - $item->stok_bulanlalu;
            }
            return $item;
        });
        //dd($data);
        return view('admin.report.stokbulanan',compact('month', 'year','data'));
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
    public function grafik_stok()
    {
        $data = [];
        $pasar = Pasar::get();
        return view('admin.report.grafik_stok',compact('data','pasar'));
    }
    public function search_grafik_stok()
    {
        $pasar_id = request()->get('pasar_id');
        //$bulan = request()->get('bulan');
        $tahun = request()->get('tahun');
        // $start = Carbon::createFromFormat('m-Y', $bulan.'-'.$tahun)->startOfMonth();
        // $end = Carbon::createFromFormat('m-Y', $bulan.'-'.$tahun)->endOfMonth();
        //dd($pasar_id, $tahun);
        // $date = CarbonPeriod::create($start, $end);
        // $dates = [];
        // foreach($date as $d){
        //     $dates[] = $d->format('Y-m-d');
        // }

        // $data['tanggal'] = $dates;
        
        $bahan = Bahan::get();
        

        //dd($rgbColor);
        // $data = [
        //     [
        //       'label' => 'Beras jawa',
        //       'fill'  => false,
        //       'data'  => [3,432,543,65,75,65,456,345,23],
        //       'borderColor' => [
        //           'rgba(255, 255, 146, 1)'
        //       ],
        //       'borderWidth' => 2
        //     ]
        // ];


        foreach($bahan as $item){
            $rgbColor = array();
            foreach(array('r', 'g', 'b') as $color){
                $rgbColor[$color] = mt_rand(0, 255);
            }
            
            $data[] = [
                'label' => $item->nama,
                'fill' => false,
                'data' => $item->stok->pluck('minggu_1')->toArray(),
                'borderColor' => [
                    'rgba('.$rgbColor['r'].', '.$rgbColor['g'].', '.$rgbColor['b'].')'
                ],
            ];
        }
        request()->flash();
        //dd($data, $d);
        return view('admin.report.grafik_stok',compact('data', 'pasar_id', 'tahun'));
    }

}
