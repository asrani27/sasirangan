<?php

namespace App\Http\Controllers;

use App\Bahan;
use App\Pasar;
use App\Satuan;
use App\Kelompok;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    public function index()
    {
        $data = Bahan::orderBy('id')->paginate(10);
        return view('admin.bahan.index', compact('data'));
    }

    public function create()
    {
        $satuan = Satuan::get();
        $kelompok = Kelompok::get();
        return view('admin.bahan.add', compact('satuan', 'kelompok'));
    }

    public function store(Request $req)
    {
        $pasar_id = Pasar::get()->pluck('id');
        $attr = $req->all();
        $check = Bahan::where('nama', $req->nama)->first();
        if ($check != null) {
            toastr()->error('Nama Bahan Sudah Ada');
            return back();
        } else {

            $b = Bahan::create($attr);
            //$b->pasar()->attach($pasar_id);
            toastr()->success('Nama Bahan Berhasil Di Simpan');
            return redirect('/data/bahan');
        }
    }

    public function edit($id)
    {
        $data = Bahan::find($id);
        $satuan = Satuan::get();
        $kelompok = Kelompok::get();
        return view('admin.bahan.edit', compact('satuan', 'kelompok', 'data'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        Bahan::find($id)->update($attr);
        toastr()->success('Bahan Berhasil Di Update');
        return redirect('/data/bahan');
    }

    public function delete($id)
    {
        $pasar_id = Pasar::get()->pluck('id');
        $b = Bahan::find($id);
        $b->pasar()->detach($pasar_id);
        $b->delete();
        toastr()->success('Bahan Berhasil Di Hapus');
        return back();
    }


    public function updateUser(Request $request)
    {
        $data = Bahan::find($request->pk);
        $data->nama = $request->value;
        $data->save();

        return response()->json(['success' => 'done']);
    }
}
