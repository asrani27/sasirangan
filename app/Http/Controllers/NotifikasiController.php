<?php

namespace App\Http\Controllers;

use App\EWS;
use Carbon\Carbon;
use App\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotifikasiController extends Controller
{

    public function kirimNotif()
    {
        $bapokNaik = EWS::where('tanggal', Carbon::now()->format('Y-m-d'))->get()->map(function ($item) {
            $item->nama_bahan = $item->bahan->nama;
            $item->nama_pasar = $item->pasar->nama;
            return $item->only(['nama_bahan', 'nama_pasar']);
        });

        $bapok = array();
        foreach ($bapokNaik as $key => $bp) {
            //dd($bp, $bapok);
            array_push($bapok, $key + 1 . '. ' . $bp['nama_bahan'] . ' (' . $bp['nama_pasar'] . ") \n");
        }

        $pesan = implode(" ", $bapok);
        $number = Notifikasi::get();
        if ($number->count() == 0) {
            toastr()->error('Tidak ada nomor, silahkan masukkan nomor di list notifikasi');
            return back();
        }
        foreach ($number as $n) {
            $data = [
                "phoneNumber" => $n->nomor,
                "content" => [
                    "text" => Carbon::now()->translatedFormat('d F Y') .
                        "Early Warning system (EWS), \n Harga Bahan Pokok Yang mengalami Kenaikan : \n"
                        . $pesan,
                ]
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6ImUzODVmODJiLWI5ZmMtNDdlYy05MWEwLWJkZDkzYzQ5Njc2NyIsImlhdCI6MTY5NTYxODU0M30.ks-dSXCKtB-aeigPwFZVPJ4b9gP_QculLQmw25Ypey4',
            ])
                ->withBody(json_encode($data), 'application/json')
                ->post('https://api.wa.banjarmasinkota.go.id/whatsapp/e385f82b-b9fc-47ec-91a0-bdd93c496767/messages');
        }
        toastr()->success(' Berhasil Di Kirim');
        return back();
    }
    public function index()
    {
        $data = Notifikasi::orderBy('id', 'DESC')->paginate(10);
        return view('admin.notifikasi.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = Notifikasi::where('nomor', $req->nomor)->first();
        if ($check != null) {
            toastr()->error('Nomor Sudah Ada');
            return back();
        } else {
            $p = Notifikasi::create($attr);
            toastr()->success('Nomor Berhasil Di Simpan');
            return back();
        }
    }
    public function edit($id)
    {
        $data = Notifikasi::orderBy('id', 'DESC')->paginate(10);
        $edit = Notifikasi::find($id);
        return view('admin.notifikasi.edit', compact('data', 'edit'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $data = Notifikasi::find($id);
        $data->nomor = $req->nomor;
        $data->save();
        toastr()->success('Nomor Berhasil Di Update');
        return redirect('/data/notifikasi');
    }

    public function delete($id)
    {
        $b = Notifikasi::find($id);
        $b->delete();
        toastr()->success('Nomor Berhasil Di Hapus');
        return redirect('/data/notifikasi');
    }
}
