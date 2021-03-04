@extends('layouts.app')

@section('title')
<h4 class="page-title">Edit Slider</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Edit Slider</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <form method="POST" action="/informasi/slider/edit/{{$data->id}}" enctype="multipart/form-data">
                    @csrf
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" value="{{$data->judul}}" name="judul" id="example-text-input">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="file" id="example-text-input">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input-lg" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="/informasi/slider" class="btn btn-secondary waves-effect waves-light">
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