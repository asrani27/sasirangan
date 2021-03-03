<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use toastr;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::paginate(10);
        return view('admin.kategori.index',compact('data'));
    }
    
    public function create()
    {
        
    }
    
    public function store(Request $req)
    {
        $attr = $req->all();
        $check = Kategori::where('nama', $req->nama)->first();
        if($check != null){
            toastr()->error('Nama Kategori Sudah Ada');
            return back();
        }else{
            Kategori::create($attr);
            toastr()->success('Nama Kategori Berhasil Di Simpan');
            return back();
        }
    }
    
    public function edit($id)
    {
        $data = Kategori::orderBy('id','DESC')->paginate(10);
        $edit = Kategori::find($id);
        return view('admin.kategori.edit',compact('data','edit'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $data = Kategori::find($id);
        $data->nama = $req->nama;
        $data->save();
        toastr()->success('Nama Kategori Berhasil Di Update');
        return redirect('/informasi/kategori');
    }

    public function delete($id)
    {
        Kategori::find($id)->delete();
        toastr()->success('Nama Kategori Berhasil Di Hapus');
        return redirect('/informasi/kategori');
    }
}
