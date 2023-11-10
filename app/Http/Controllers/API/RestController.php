<?php

namespace App\Http\Controllers\API;

use App\Bahan;
use App\Harga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RestController extends Controller
{
    public function user()
    {
        $data['message']        = 'Data Ditemukan';
        $data['nama']           = Auth::user()->name;
        $data['username']       = Auth::user()->username;
        $data['pasar']          = Auth::user()->pasar;

        return response()->json($data);
    }

    public function gantipassword(Request $req)
    {
        $resp = Auth::user()->update([
            'password' => bcrypt($req->password),
        ]);

        $data['message']        = 'Password Berhasil Diganti';
        $data['data']           = $resp;

        return response()->json($data);
    }
    public function komoditi(Request $req)
    {
        //menampilkan data bahan pokok berdasarkan pasar_id dan tanggal
        $harga = Harga::where('pasar_id', $req->pasar_id)->where('tanggal', $req->tanggal)->get()->map(function ($item) {
            $item->komoditi = Bahan::find($item->bahan_id)->nama;
            $item->harga = number_format($item->harga);
            return $item;
        });

        $data['message']        = 'Data Ditemukan';
        $data['data']           = $harga;

        return response()->json($data);
    }

    public function updateKomoditi(Request $req)
    {
        //menampilkan data bahan pokok berdasarkan pasar_id dan tanggal
        Harga::find($req->harga_id)->update([
            'harga' => $req->harga,
        ]);
        $databahan = Harga::where('pasar_id', $req->pasar_id)->where('tanggal', $req->tanggal)->get()->map(function ($item) {
            $item->komoditi = Bahan::find($item->bahan_id)->nama;
            $item->harga = number_format($item->harga);
            return $item;
        });
        $data['message']        = 'Data Ditemukan';
        $data['data']           = $databahan;

        return response()->json($data);
    }
    public function login(Request $req)
    {
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password])) {
            $user = Auth::user();
            if ($user->tokens()->first() == null) {
                $token = $user->createToken($req->username)->plainTextToken;
            } else {
                $user->tokens()->delete();
                $token = $user->createToken($req->username)->plainTextToken;
            }
            $data['message']       = 'Data Ditemukan';
            $data['data']          = Auth::user();
            $data['api_token']     = $token;
            return response()->json($data);
        } else {
            $data['message']       = 'username atau password anda tidak ditemukan';
            $data['data']          = null;
            return response()->json($data);
        }
    }
}
