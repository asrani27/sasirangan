<?php

namespace App\Http\Controllers;

use App\User;
use App\Bahan;
use App\BulanTahun;
use App\Harga;
use App\HargaAcuan;
use App\Pasar;
use App\PasarUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasarController extends Controller
{
    public function index()
    {
        $data = Pasar::orderBy('id', 'DESC')->paginate(10);
        $user = User::where('username', '!=', 'superadmin')->get();
        return view('admin.pasar.index', compact('data', 'user'));
    }

    public function generateHarga()
    {
        $today = Carbon::now()->format('Y-m-d');
        $pasar = Pasar::get()->map(function ($item) use ($today) {
            $item->bahan = $item->bahan->map(function ($item2) use ($item, $today) {

                $checkToday = Harga::where('tanggal', $today)->where('pasar_id', $item->id)->where('bahan_id', $item2->id)->first();
                if ($checkToday == null) {
                    //simpan baru
                    $n = new Harga;
                    $n->tanggal = $today;
                    $n->pasar_id = $item->id;
                    $n->bahan_id = $item2->id;
                    $n->harga = 0;
                    $n->save();
                }

                return $item2;
            });
            return $item;
        })->toArray();
        toastr()->success('Berhasil digenerate');
        return back();
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

    public function bapok($id)
    {
        $data = Pasar::find($id);
        $bahanku = Pasar::find($id)->bahan->pluck('id')->toArray();
        $bapok = Bahan::get();
        return view('admin.pasar.bapok', compact('data', 'bapok', 'bahanku'));
    }

    public function updateBapok(Request $req, $id)
    {
        $data = Pasar::find($id)->bahan()->sync($req->bahan_id);

        toastr()->success('Berhasil Di Update');
        return back();
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

    public function harga($id)
    {
        $pasar = Pasar::find($id);
        $bulantahun = BulanTahun::where('pasar_id', $id)->orderBy('bulan', 'DESC')->get();
        return view('admin.pasar.harga', compact('pasar', 'bulantahun'));
    }
    public function acuan($id, $bulan_id)
    {
        $pasar = Pasar::find($id);
        $bulantahun = BulanTahun::find($bulan_id);
        $bahan = Pasar::find($id)->bahan->map(function ($item) use ($id, $bulan_id) {
            $check = HargaAcuan::where('bulan_tahun_id', $bulan_id)->where('bahan_id', $item->id)->where('pasar_id', $id)->first();
            if ($check == null) {
                $item->harga = 0;
            } else {
                $item->harga = $check->harga;
            }
            return $item;
        });

        return view('admin.pasar.acuan', compact('bulantahun', 'id', 'bulan_id', 'bahan', 'pasar'));
    }

    public function storeAcuan(Request $req, $id, $bulan_id)
    {

        foreach ($req->bapok_id as $key => $item) {
            $check = HargaAcuan::where('bulan_tahun_id', $bulan_id)->where('bahan_id', $item)->where('pasar_id', $id)->first();
            if ($check == null) {
                //simpan
                $n = new HargaAcuan;
                $n->bulan_tahun_id = $bulan_id;
                $n->bahan_id = $item;
                $n->harga = $req->harga[$key];
                $n->pasar_id = $id;
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
    public function deleteBulanTahun($id, $bulan_id)
    {
        BulanTahun::find($bulan_id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }
    public function bulanTahun(Request $req, $id)
    {
        $check = BulanTahun::where('pasar_id', $id)->where('bulan', $req->bulan)->where('tahun', $req->tahun)->first();
        if ($check == null) {
            $n = new BulanTahun;
            $n->bulan = $req->bulan;
            $n->tahun = $req->tahun;
            $n->pasar_id = $id;
            $n->save();
            toastr()->success('berhasil Disimpan');
            return redirect('/data/pasar/harga/' . $id);
        } else {
            toastr()->error('Sudah ada');
            return back();
        }
    }
    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $data = Pasar::find($id);
        $data->nama = $req->nama;
        $data->tampil_stok = $req->tampil_stok;
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
