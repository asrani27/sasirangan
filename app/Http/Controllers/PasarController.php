<?php

namespace App\Http\Controllers;

use App\Bahan;
use App\Pasar;
use Illuminate\Http\Request;

class PasarController extends Controller
{
    public function index()
    {
        $data = Pasar::orderBy('id','DESC')->paginate(10);
        return view('admin.pasar.index',compact('data'));
    }
    
    public function create()
    {
        
    }
    
    
    public function store(Request $req)
    {
        $attr = $req->all();
        
        $bahan_id = Bahan::get()->pluck('id');
        $check = Pasar::where('nama', $req->nama)->first();
        if($check != null){
            toastr()->error('Nama Pasar Sudah Ada');
            return back();
        }else{
            $p = Pasar::create($attr);
            $p->bahan()->attach($bahan_id);
            toastr()->success('Nama Pasar Berhasil Di Simpan');
            return back();
        }
    }
    
    public function edit($id)
    {
        $data = Pasar::orderBy('id','DESC')->paginate(10);
        $edit = Pasar::find($id);
        return view('admin.pasar.edit',compact('data','edit'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $data = Pasar::find($id);
        $data->nama = $req->nama;
        $data->save();
        toastr()->success('Nama Pasar Berhasil Di Update');
        return redirect('/data/pasar');
    }

    public function delete($id)
    {
        $bahan_id = Bahan::get()->pluck('id');
        $b = Pasar::find($id);
        $b->bahan()->detach($bahan_id);
        $b->delete();
        toastr()->success('Nama Pasar Berhasil Di Hapus');
        return redirect('/data/pasar');
    }
}
