@extends('layouts.app')

@section('title')
<h4 class="page-title">Edit Bahan</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Edit Bahan</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <form method="POST" action="/data/bahan/edit/{{$data->id}}" enctype="multipart/form-data">
                    @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kelompok Bahan</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="kelompok_id" required>
                            <option value="">-Pilih-</option>
                            @foreach ($kelompok as $k)
                                <option value="{{$k->id}}" {{$data->kelompok_id == $k->id ? 'selected' : ''}}>{{$k->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Nama Bahan</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" value="{{$data->nama}}" name="nama" id="example-text-input" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Satuan</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="satuan_id" required>
                            <option value="">-Pilih-</option>
                            @foreach ($satuan as $s)
                                <option value="{{$s->id}}" {{$data->satuan_id == $s->id ? 'selected' : ''}}>{{$s->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input-lg" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="/data/bahan" class="btn btn-secondary waves-effect waves-light">
                            <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                        </a>
                    </div>
                </div>
                </form>
                
            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection