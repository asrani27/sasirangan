@extends('layouts.app')

@section('title')
<h4 class="page-title">Tambah Berita</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Tambah berita</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <form method="POST" action="/informasi/berita/add" enctype="multipart/form-data">
                    @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kategori Berita</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="kategori_id" required>
                            <option value="">-Pilih-</option>
                            @foreach ($kategori as $k)
                                <option value="{{$k->id}}">{{$k->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Judul Berita" name="judul" id="example-text-input">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="example-text-input-lg" class="col-sm-2 col-form-label">Isi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control form-control-lg" name="isi" rows=5>Deskripsi Berita</textarea>
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
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="/informasi/berita" class="btn btn-secondary waves-effect waves-light">
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