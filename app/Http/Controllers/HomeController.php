<?php

namespace App\Http\Controllers;

use App\Pasar;
use App\Traffic;
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
        return view('admin.home',compact('data','pasar','tahun2021'));
    }
}
