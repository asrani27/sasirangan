<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RestController extends Controller
{
    public function user()
    {
        $data['message']       = 'Data Ditemukan';
        $data['data']          = Auth::user();
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
            $data['pasar']         = Auth::user();
            $data['api_token']     = $token;
            return response()->json($data);
        } else {
            $data['message']       = 'username atau password anda tidak ditemukan';
            $data['data']          = null;
            return response()->json($data);
        }
    }
}
