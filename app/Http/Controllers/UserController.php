<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::where('username', '!=', 'superadmin')->paginate(15);
        return view('admin.user.index', compact('data'));
    }

    public function create()
    {
    }

    public function reset($id)
    {
        User::find($id)->update([
            'password' => bcrypt('123123'),
        ]);
        toastr()->error('Berhasil Direset, Passwordnya 123123');
        return back();
    }
    public function store(Request $req)
    {
        $check = User::where('username', $req->username)->first();
        if ($check != null) {
            toastr()->error('Username sudah ada, gunakan yang lain');
            return back();
        } else {
            $role = Role::where('name', 'petugas')->first();
            $n = new User;
            $n->name = $req->nama;
            $n->username = $req->username;
            $n->password = bcrypt($req->password);
            $n->save();
            $n->roles()->attach($role);

            $n->createToken($req->username)->plainTextToken;

            toastr()->success('Berhasil di simpan, passwordnya : ' . $req->password);
            return back();
        }
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
