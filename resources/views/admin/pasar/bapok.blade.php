@extends('layouts.app')
@push('css')
    
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
<style>
    #mapid {
        height: 380px;
    }
</style>
@endpush
@section('title')
<h4 class="page-title">Bahan Pokok</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Bahan Pokok</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <form class="" action="/data/pasar/bapok/{{$data->id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Pasar</label>
                        <input type="text" class="form-control" name="nama" value="{{$data->nama}}" readonly>
                    </div>
                    
                    
                    {{-- <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="/data/pasar" class="btn btn-secondary waves-effect waves-light">
                                <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                            </a>
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                
                <form class="" action="/data/pasar/bapok/{{$data->id}}" method="POST">
                    @csrf
                <div class="form-group">
                    <label>BAHAN POKOK</label>
                </div>
                @foreach ($bapok as $item)
                <li>
                    <input type="checkbox" name="bahan_id[]" value="{{$item->id}}"  {{ in_array($item->id, $bahanku) ? 'checked' : '' }}> {{$item->nama}}
                </li>
                @endforeach
                <br/>
                <div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="/data/pasar" class="btn btn-secondary waves-effect waves-light">
                        <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                    </a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')

@endpush