<?php

namespace App\Http\Controllers;

use App\Bahan;
use App\BulanTahun;
use App\HargaAcuan;
use Illuminate\Http\Request;

class HargaAcuanController extends Controller
{
    public function index()
    {
        $data = BulanTahun::orderBy('id', 'DESC')->paginate(10);
        return view('admin.acuan.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();

        $check = BulanTahun::where('bulan', $req->bulan)->where('tahun', $req->tahun)->first();
        if ($check != null) {
            toastr()->error('Bulan Tahun Sudah Ada');
            return back();
        } else {
            $p = BulanTahun::create($attr);
            toastr()->success('Berhasil Di Simpan');
            return back();
        }
    }
    public function hargaacuan($id)
    {
        $bulantahun = BulanTahun::find($id);
        $bahan = Bahan::get()->map(function ($item) use ($id) {
            $check = HargaAcuan::where('bulan_tahun_id', $id)->where('bahan_id', $item->id)->first();
            if ($check == null) {
                $item->harga = 0;
            } else {
                $item->harga = $check->harga;
            }
            return $item;
        });

        return view('admin.acuan.harga', compact('bulantahun', 'id', 'bahan'));
    }

    public function storeHargaAcuan(Request $req, $id)
    {
        foreach ($req->bapok_id as $key => $item) {
            $check = HargaAcuan::where('bulan_tahun_id', $id)->where('bahan_id', $item)->first();
            if ($check == null) {
                //simpan
                $n = new HargaAcuan;
                $n->bulan_tahun_id = $id;
                $n->bahan_id = $item;
                $n->harga = $req->harga[$key];
                $n->save();
            } else {
                //update
                $check->update([
                    'harga' => $req->harga[$key],
                ]);
            }
        }
        toastr()->success(' Berhasil Di Update');
        return back();
    }
    public function delete($id)
    {
        BulanTahun::find($id)->delete();
        toastr()->success(' Berhasil Di Hapus');
        return redirect('/data/hargaacuan');
    }
}
