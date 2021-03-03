<?php

namespace App\Http\Controllers;

use App\Bahan;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    public function index()
    {
        $data = Bahan::orderBy('id')->paginate(10);
        return view('admin.bahan.index',compact('data'));
    }
    
    public function create()
    {
        
    }
    
    public function store()
    {
        
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
