@extends('layouts.app')

@section('title')
<h4 class="page-title">Nomor Notifikasi</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Nomor Notifikasi</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <form class="" action="/data/notifikasi/add" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nomor Penerima Notifikasi</label>
                        <input type="text" class="form-control" name="nomor" placeholder="Nomor" required>
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                <i class="fas fa-save"></i> Simpan
                            </button>
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
                        <th>Nomor</th>
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
                                <td style="padding:5px 12px;">{{$item->nomor}}</td>
                                <td style="padding:5px 12px;">
                                    <a href="/data/notifikasi/kirim/{{$item->id}}" class="btn btn-sm btn-success waves-effect waves-light"><i class="fas fa-comment"></i> Kirim Notif</a>
                                    <a href="/data/notifikasi/edit/{{$item->id}}" class="btn btn-sm btn-success waves-effect waves-light"><i class="fas fa-edit"></i></a>
                                    <a href="/data/notifikasi/delete/{{$item->id}}" class="btn btn-sm btn-danger waves-effect waves-light" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fas fa-times"></i></a>
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

@push('js')

@endpush