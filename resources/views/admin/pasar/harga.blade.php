@extends('layouts.app')

@section('title')
<h4 class="page-title">Harga Acuan {{$pasar->nama}}</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Harga Acuan {{$pasar->nama}}</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <form class="" action="/data/pasar/harga/{{$pasar->id}}/tahunbulan" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Bulan</label>
                        <select class="form-control" name="bulan" required>
                            <option value="">-pilih-</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="text" class="form-control" name="tahun" placeholder="tahun" required onkeypress="return hanyaAngka(event)">
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="/data/pasar" class="btn btn-secondary waves-effect waves-light">
                                <i class="fas fa-arrow-left"></i> Kembali
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
                        <th>Bulan Tahun</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    @php
                        $no =1;
                    @endphp
                    <tbody>
                        @foreach ($bulantahun as $item)
                            <tr style="padding:5px 12px;">
                                <td style="padding:5px 12px;">{{$no++}}</td>
                                <td style="padding:5px 12px;">{{\Carbon\Carbon::createFromFormat('d/m','01/'.$item->bulan)->translatedFormat('F')}} {{$item->tahun}}</td>
                                <td style="padding:5px 12px;">
                                    <a href="/data/pasar/harga/{{$pasar->id}}/acuan/{{$item->id}}" class="btn btn-sm btn-success waves-effect waves-light"><i class="fas fa-list"></i> Harga Acuan Bapok</a>
                                    <a href="/data/pasar/harga/{{$pasar->id}}/delete/{{$item->id}}" class="btn btn-sm btn-danger waves-effect waves-light" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
            {{-- {{$data->links()}} --}}
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
@endpush