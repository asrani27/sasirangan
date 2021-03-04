<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index()
    {
        $data = Slider::orderBy('id','DESC')->paginate(10);
        return view('admin.slider.index',compact('data'));
    }
    
    public function create()
    {
        return view('admin.slider.add');
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
        
        Slider::create($attr);
        toastr()->success('Slider Berhasil Di Simpan');
        return redirect('/informasi/slider');
    }
    
    public function edit($id)
    {
        $data = Slider::find($id);
        return view('admin.slider.edit',compact('data'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        Slider::find($id)->update($attr);
        toastr()->success('Slider Berhasil Di Update');
        return redirect('/informasi/slider');
    }

    public function delete($id)
    {
        Slider::find($id)->delete();
        toastr()->success('Slider Berhasil Di Hapus');
        return back();
    }
}
