<?php

namespace App\Http\Controllers;

use App\User;
use App\Bahan;
use App\Pasar;
use App\PasarUser;
use Illuminate\Http\Request;

class PasarController extends Controller
{
    public function index()
    {
        $data = Pasar::orderBy('id', 'DESC')->paginate(10);
        $user = User::where('username', '!=', 'superadmin')->get();
        return view('admin.pasar.index', compact('data', 'user'));
    }

    public function petugas(Request $req)
    {
        $check = PasarUser::where('pasar_id', $req->pasar_id)->where('user_id', $req->user_id)->first();
        if ($check == null) {
            $n = new PasarUser;
            $n->pasar_id = $req->pasar_id;
            $n->user_id = $req->user_id;
            $n->save();
            toastr()->success('Petugas berhasil Ditambahkan');
            return back();
        } else {
            toastr()->error('Petugas Sudah terdaftar di pasar ini');
            return back();
        }
    }

    public function hapusPetugas($id)
    {
        $data = Pasar::find($id)->user()->detach();
        toastr()->success('Petugas dihapus');
        return back();
    }

    public function store(Request $req)
    {
        $attr = $req->all();

        $bahan_id = Bahan::get()->pluck('id');
        $check = Pasar::where('nama', $req->nama)->first();
        if ($check != null) {
            toastr()->error('Nama Pasar Sudah Ada');
            return back();
        } else {
            $p = Pasar::create($attr);
            $p->bahan()->attach($bahan_id);
            toastr()->success('Nama Pasar Berhasil Di Simpan');
            return back();
        }
    }

    public function edit($id)
    {
        $data = Pasar::orderBy('id', 'DESC')->paginate(10);
        $edit = Pasar::find($id);
        return view('admin.pasar.edit', compact('data', 'edit'));
    }

    public function lokasi($id)
    {
        $edit = Pasar::find($id);
        if ($edit->lat == null) {
            $latlong = [
                'lat' => -3.327653847548605,
                'lng' => 114.5884147286779,
            ];
        } else {
            $latlong = [
                'lat' => $edit->lat,
                'lng' => $edit->long,
            ];
        }

        if ($edit->radius == null) {
            $radius = 100;
        } else {
            $radius = $edit->radius;
        }
        return view('admin.pasar.lokasi', compact('edit', 'latlong', 'radius'));
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

    public function updateLokasi(Request $req, $id)
    {

        $data = Pasar::find($id);
        $data->lat = $req->lat;
        $data->long = $req->long;
        $data->radius = $req->radius;
        $data->save();
        toastr()->success('Nama Pasar Berhasil Di Update');
        return back();
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
