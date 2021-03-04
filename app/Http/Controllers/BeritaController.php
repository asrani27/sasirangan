<?php

namespace App\Http\Controllers;

use App\Berita;
use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::orderBy('id','DESC')->paginate(10);
        return view('admin.berita.index',compact('data'));
    }
    
    public function create()
    {
        $kategori = Kategori::get();
        return view('admin.berita.add',compact('kategori'));
    }
    
    public function store(Request $req)
    {
        $attr = $req->all();

        $validator = Validator::make($attr, [
            'file' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {            
            toastr()->error('File Harus Gambar Dan Max 2MB');
            return back();
        }
        
        if($req->hasFile('file'))
        {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-').rand(1,9999).$filename;
            $req->file->storeAs('/public',$filename);
            $attr['file'] = $filename;
        }
        
        Berita::create($attr);
        toastr()->success('Berita Berhasil Di Simpan');
        return redirect('/informasi/berita');
    }
    
    public function edit($id)
    {
        $kategori = Kategori::get();
        $data = Berita::find($id);
        return view('admin.berita.edit',compact('kategori','data'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $validator = Validator::make($attr, [
            'file' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {            
            toastr()->error('File Harus Gambar Dan Max 2MB');
            return back();
        }
        
        if($req->hasFile('file'))
        {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-').rand(1,9999).$filename;
            $req->file->storeAs('/public',$filename);
            $attr['file'] = $filename;
        }
        Berita::find($id)->update($attr);
        toastr()->success('Berita Berhasil Di Update');
        return redirect('/informasi/berita');
    }

    public function delete($id)
    {
        Berita::find($id)->delete();
        toastr()->success('Berita Berhasil Di Hapus');
        return back();
    }
}
