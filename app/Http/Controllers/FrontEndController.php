<?php

namespace App\Http\Controllers;

use App\Berita;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function beranda()
    {
        $berita = Berita::orderBy('id','DESC')->limit(4)->get();
        return view('frontend.beranda',compact('berita'));
    }

    public function info_harga()
    {
        return view('frontend.info_harga');
    }

    public function info_stok()
    {
        return view('frontend.info_stok');
    }

    public function grafik()
    {
        return view('frontend.grafik');
    }

    public function login()
    {
        return view('frontend.login');
    }
}
