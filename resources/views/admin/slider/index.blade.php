@extends('layouts.app')

@section('title')
<h4 class="page-title">Slider</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Slider</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="btn-toolbar p-3" role="toolbar">
                <div class="col-md-10">

                <div class="btn-group">
                    <a href="/informasi/slider/add" class="btn btn-primary waves-light waves-effect"><i class="mdi mdi-newspaper"></i> Tambah Slider</a>
                </div>
                </div>
                <div class="col-md-2">

                <div class="btn-group">
                    <input type="text" class="form-control" placeholder="Cari"><a href="#" class="btn btn-secondary"><i class="fas fa-search"></i></a>
                </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul Slider</th>
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
                                <td style="padding:5px 12px;">
                                    @if ($item->file == null)
                                    <img src="/theme/assets/images/small/img-3.jpg" width="70px" height="40px">
                                        
                                    @else
                                    <img src="/storage/{{$item->file}}" width="70px" height="40px">
                                        
                                    @endif
                                    
                                </td>
                                <td style="padding:5px 12px;">{{$item->judul}}</td>
                                <td style="padding:5px 12px;">
                                    <a href="/informasi/slider/edit/{{$item->id}}" class="btn btn-sm btn-success waves-effect waves-light"><i class="fas fa-edit"></i></a>
                                    <a href="/informasi/slider/delete/{{$item->id}}" class="btn btn-sm btn-danger waves-effect waves-light" onclick="return confirm('Yakin menghapus Berita ini?');"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
            {{$data->links()}}
            </div>
        </div>
    </div>
</div>
@endsection