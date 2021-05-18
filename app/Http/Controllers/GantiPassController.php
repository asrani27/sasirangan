<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GantiPassController extends Controller
{
    public function index()
    {   
        return view('admin.gantipass');
    }
    
    public function change(Request $req)
    {
        if($req->password != $req->password2){
            toastr()->error('Password Tidak Sama');
        }else{
            $data = Auth::user();
            $data->password = bcrypt($req->password);
            $data->save();
            toastr()->success('Password Berhasil Di Ubah');
        }
        return back();
    }
}
