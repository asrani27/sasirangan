<?php

namespace App\Http\Controllers;

use App\NomorAduan;
use Illuminate\Http\Request;

class AduanController extends Controller
{
    public function index()
    {
        $data = NomorAduan::first();
        return view('admin.nomoraduan.index', compact('data'));
    }

    public function update(Request $req)
    {
        if (NomorAduan::first() == null) {
            $n = new NomorAduan;
            $n->nomor = $req->nomor;
            $n->save();
        } else {
            NomorAduan::first()->update([
                'nomor' => $req->nomor,
            ]);
        }

        toastr()->success('Nomor Aduan Berhasil Di Update');
        return back();
    }
}
