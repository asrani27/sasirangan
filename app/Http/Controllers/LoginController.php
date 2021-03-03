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
            return redirect('/home');
        } else {
            toastr()->error('Username / Password Tidak Ditemukan');
            return back();
        }
    }
}
