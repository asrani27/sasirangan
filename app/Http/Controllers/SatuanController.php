<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
    {
        $data = Satuan::orderBy('id','DESC')->paginate(10);
        return view('admin.satuan.index',compact('data'));
    }
    
    public function create()
    {
        
    }
    
    
    public function store(Request $req)
    {
        $attr = $req->all();
        $check = Satuan::where('nama', $req->nama)->first();
        if($check != null){
            toastr()->error('Nama Satuan Sudah Ada');
            return back();
        }else{
            Satuan::create($attr);
            toastr()->success('Nama Satuan Berhasil Di Simpan');
            return back();
        }
    }
    
    public function edit($id)
    {
        $data = Satuan::orderBy('id','DESC')->paginate(10);
        $edit = Satuan::find($id);
        return view('admin.satuan.edit',compact('data','edit'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $data = Satuan::find($id);
        $data->nama = $req->nama;
        $data->save();
        toastr()->success('Nama Satuan Berhasil Di Update');
        return redirect('/data/satuan');
    }

    public function delete($id)
    {
        try{
            Satuan::find($id)->delete();
            toastr()->success('Nama Satuan Berhasil Di Hapus');
            return redirect('/data/satuan');
        }catch(\Exception $e){
            toastr()->error('Tidak bisa di hapus karena ada bahan yg mengacu pada data ini');
            return back();
        }
    }
}
