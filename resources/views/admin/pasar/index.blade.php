@extends('layouts.app')

@section('title')
<h4 class="page-title">Pasar</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Pasar</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <form class="" action="/data/pasar/add" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Pasar</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Pasar" required>
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
                <a href="/data/pasar/generateharga" class="btn btn-md btn-danger waves-effect waves-light"  onclick="return confirm('Yakin ingin menggenerate data harga hari ini ini?');"><i class="fas fa-recycle"></i> Generate Harga Bapok hari ini</a><br/><br/>
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasar</th>
                        <th>Petugas</th>
                        <th>Tampilkan Di Stok</th>
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
                                <td>
                                    @foreach ($item->user as $item2)
                                        {{$item2->name}},
                                    @endforeach
                                    <br/>
                                    <a href="#" class="btn btn-sm btn-success waves-effect waves-light petugas" data-pasar_id="{{$item->id}}"><i class="fas fa-user-plus"></i></a>
                                    <a href="/data/pasar/{{$item->id}}/hapus-petugas" class="btn btn-sm btn-danger waves-effect waves-light" onclick="return confirm('semua petugas di pasar ini akan di hapus, yakin?');"><i class="fas fa-trash"></i></a>
                                </td>
                                <td style="padding:5px 12px;">
                                    
                                    {{$item->tampil_stok}}</td>
                                <td style="padding:5px 12px;">
                                    <a href="/data/pasar/lokasi/{{$item->id}}" class="btn btn-sm btn-success waves-effect waves-light"><i class="fas fa-map-marker"></i> Lokasi</a>
                                    <a href="/data/pasar/bapok/{{$item->id}}" class="btn btn-sm btn-success waves-effect waves-light"><i class="fas fa-list"></i> Bapok</a>
                                    <a href="/data/pasar/edit/{{$item->id}}" class="btn btn-sm btn-success waves-effect waves-light"><i class="fas fa-edit"></i></a>
                                    <a href="/data/pasar/delete/{{$item->id}}" class="btn btn-sm btn-danger waves-effect waves-light" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fas fa-times"></i></a>
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

 <!-- sample modal content -->
 <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Tambah Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form method="post" action="/data/pasar/petugas">
            @csrf
            <div class="modal-body">
                <select class="form-control" name="user_id" required>
                    <option value="">-pilih petugas-</option>
                    @foreach ($user as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="pasar_id" id="pasar_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $(".petugas").click(function(){
            $("#pasar_id").val($(this).data("pasar_id"));
            $("#myModal").modal('show');
        });
    });
</script>
@endpush