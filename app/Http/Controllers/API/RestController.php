<?php

namespace App\Http\Controllers\API;

use App\Bahan;
use App\Pasar;
use App\Harga;
use Carbon\Carbon;
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

    /**
     * Get all pasar data from Pasar model
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function pasar()
    {
        $pasar = Pasar::orderBy('nama')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data Pasar Ditemukan',
            'total_data' => $pasar->count(),
            'data' => $pasar,
        ]);
    }

    /**
     * Get all pasar list
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function listPasar()
    {
        $pasar = Pasar::select('id', 'nama')->get();

        $data['message'] = 'Data Pasar Ditemukan';
        $data['success'] = true;
        $data['data'] = $pasar;

        return response()->json($data);
    }

    /**
     * Get info harga (price information)
     * 
     * Query params:
     * - pasar_id: required
     * - tanggal: optional (default: today)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function infoHarga(Request $request)
    {
        $request->validate([
            'pasar_id' => 'required|exists:pasar,id',
            'tanggal' => 'nullable|date',
        ]);

        $pasar_id = $request->pasar_id;
        $tanggal = $request->tanggal ?? Carbon::today()->format('Y-m-d');
        $tanggal_sekarang = Carbon::parse($tanggal);
        $tanggal_kemarin = Carbon::parse($tanggal)->subDay();

        $pasar = Pasar::find($pasar_id);
        
        if (!$pasar) {
            return response()->json([
                'success' => false,
                'message' => 'Pasar tidak ditemukan',
            ], 404);
        }

        $bahan = $pasar->bahan;

        if ($bahan->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Tidak ada bahan pokok di pasar ini',
                'data' => [],
            ]);
        }

        $data = $bahan->map(function ($item) use ($tanggal_sekarang, $tanggal_kemarin, $pasar_id) {
            $harga_terkini = Harga::where('bahan_id', $item->id)
                ->where('tanggal', $tanggal_sekarang->format('Y-m-d'))
                ->where('pasar_id', $pasar_id)
                ->first();

            $harga_kemarin = Harga::where('bahan_id', $item->id)
                ->where('tanggal', $tanggal_kemarin->format('Y-m-d'))
                ->where('pasar_id', $pasar_id)
                ->first();

            $harga_terkini_val = $harga_terkini ? $harga_terkini->harga : 0;
            $harga_kemarin_val = $harga_kemarin ? $harga_kemarin->harga : 0;

            // Calculate perubahan
            if ($harga_terkini_val == $harga_kemarin_val) {
                $perubahan = 0;
            } else {
                $perubahan = $harga_terkini_val - $harga_kemarin_val;
            }

            // Calculate perubahan percentage
            if ($harga_kemarin_val == 0 && $harga_terkini_val != 0) {
                $perubahan_persen = 100;
            } elseif ($harga_terkini_val == 0 && $harga_kemarin_val == 0) {
                $perubahan_persen = 0;
            } elseif ($harga_kemarin_val == 0) {
                $perubahan_persen = 0;
            } else {
                $perubahan_persen = ($harga_terkini_val / $harga_kemarin_val) * 100 - 100;
            }

            return [
                'no' => null, // Set by frontend
                'bahan_pokok' => $item->nama,
                'satuan' => $item->satuan ? $item->satuan->nama : null,
                'harga_kemarin' => [
                    'tanggal' => $tanggal_kemarin->format('d-M-Y'),
                    'harga' => $harga_kemarin_val,
                    'formatted' => 'Rp ' . number_format($harga_kemarin_val),
                ],
                'harga_terkini' => [
                    'tanggal' => $tanggal_sekarang->format('d-M-Y'),
                    'harga' => $harga_terkini_val,
                    'formatted' => 'Rp ' . number_format($harga_terkini_val),
                ],
                'perubahan' => [
                    'harga' => $perubahan,
                    'formatted' => 'Rp ' . number_format($perubahan),
                ],
                'perubahan_persen' => round($perubahan_persen, 2) . ' %',
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Data Harga Ditemukan',
            'pasar' => [
                'id' => $pasar->id,
                'nama' => $pasar->nama,
            ],
            'tanggal' => $tanggal_sekarang->format('Y-m-d'),
            'tanggal_kemarin' => $tanggal_kemarin->format('Y-m-d'),
            'total_data' => $data->count(),
            'data' => $data->values(),
        ]);
    }
}
