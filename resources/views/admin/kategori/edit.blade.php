@extends('layouts.app')

@section('title')
<h4 class="page-title">Edit Kategori Berita</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Edit Kategori berita</li>
</ol>
@endsection


@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <form class="" action="/informasi/kategori/edit/{{$edit->id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" class="form-control" name="nama" value="{{$edit->nama}}" required>
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="/informasi/kategori" class="btn btn-secondary waves-effect waves-light">
                                <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    @php
                        $no =1;
                    @endphp
                    <tbody>
                        @foreach ($data as $item)
                            <tr style="padding:5px 12px;">
                                <td style="padding:5px 12px;">{{$no++}}</td>
                                <td style="padding:5px 12px;">{{$item->nama}}</td>
                                <td style="padding:5px 12px;">
                                    <a href="/informasi/kategori/edit/{{$item->id}}" class="btn btn-sm btn-success waves-effect waves-light"><i class="fas fa-edit"></i></a>
                                    <a href="/informasi/kategori/delete/{{$item->id}}" class="btn btn-sm btn-danger waves-effect waves-light" onclick="return confirm('Akan menghapus berita yang terkait dengan kategori ini, Yakin?');"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>
@endsection