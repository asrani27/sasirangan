<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use toastr;

class LoginController extends Controller
{
    public function login(Request $req)
    {
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password])) {

            if (Auth::user()->hasRole('petugas')) {
                Auth::logout();
                toastr()->info('User anda hanya bisa login di android');
                return redirect('/login');
            } else {
                return redirect('/home');
            }
        } else {
            toastr()->error('Username / Password Tidak Ditemukan');
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
