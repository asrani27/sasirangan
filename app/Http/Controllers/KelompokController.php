<?php

namespace App\Http\Controllers;

use App\Kelompok;
use Illuminate\Http\Request;

class KelompokController extends Controller
{
    public function index()
    {
        $data = Kelompok::orderBy('id','DESC')->paginate(10);
        return view('admin.kelompok.index',compact('data'));
    }
    
    public function create()
    {
        
    }
    
    public function store(Request $req)
    {
        $attr = $req->all();
        $check = Kelompok::where('nama', $req->nama)->first();
        if($check != null){
            toastr()->error('Nama Kelompok Sudah Ada');
            return back();
        }else{
            Kelompok::create($attr);
            toastr()->success('Nama Kelompok Berhasil Di Simpan');
            return back();
        }
    }
    
    
    public function edit($id)
    {
        $data = Kelompok::paginate(10);
        $edit = Kelompok::find($id);
        return view('admin.kelompok.edit',compact('data','edit'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $data = Kelompok::find($id);
        $data->nama = $req->nama;
        $data->save();
        toastr()->success('Nama Kelompok Berhasil Di Update');
        return redirect('/data/kelompok');
        
    }

    public function delete($id)
    {
        Kelompok::find($id)->delete();
        toastr()->success('Nama Kelompok Berhasil Di Hapus');
        return redirect('/data/kelompok');
    }
}
