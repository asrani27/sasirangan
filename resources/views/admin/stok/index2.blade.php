@extends('layouts.app')

@section('title')
<h4 class="page-title">Stok Bahan Pokok</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Stok Bahan Pokok Pada Pasar</li>
</ol>
@endsection

@section('content')
<div class="row">
    @foreach ($pasar as $p)
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary mini-stat position-relative">
                <div class="card-body">
                    <div class="mini-stat-desc">
                        <h6 class="text-uppercase verti-label text-white-50"></h6>
                        <div class="text-white">
                            <h6 class="text-uppercase mt-0 text-white-50">Pasar</h6>
                            <a href="/input/stok/{{$p->id}}" style="color:white"><h3 class="mb-3 mt-0">{{$p->nama}}</h3></a>
                            <div class="">
                                {{-- <span class="badge badge-light text-info"> +11% </span> <span class="ml-2">From previous period</span> --}}
                            </div>
                        </div>
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-cube-outline display-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection