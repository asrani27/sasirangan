@extends('layouts.app')

@section('title')
<h4 class="page-title">Harga Acuan Bahan Pokok Bulan {{\Carbon\Carbon::createFromFormat('d/m','01/'.$bulantahun->bulan)->translatedFormat('F')}} {{$bulantahun->tahun}}</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Edit harga acuan</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">

            <form class="" action="/data/hargaacuan/bapok/{{$id}}" method="POST">
                @csrf
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan Pokok</th>
                        <th>Harga</th>
                    </tr>
                    </thead>
                    @php
                        $no =1;
                    @endphp
                    <tbody>
                        @foreach ($bahan as $item)
                            <tr style="padding:5px 12px;">
                                <td style="padding:5px 12px;">{{$no++}}</td>
                                <td style="padding:5px 12px;">{{$item->nama}}</td>
                                <td style="padding:5px 12px;">
                                    <input type="hidden" name="bapok_id[]" value="{{$item->id}}">
                                    <input type="text" name="harga[]" value="{{$item->harga}}"onkeypress="return hanyaAngka(event)">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br/>
                <div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="/data/hargaacuan" class="btn btn-secondary waves-effect waves-light">
                        <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                    </a>
                </div>
            </form>
                {{-- <form class="" action="/data/hargaacuan/bapok/{{$id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Pasar</label>
                        <input type="text" class="form-control" name="nama"  required>
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="/data/hargaacuan" class="btn btn-secondary waves-effect waves-light">
                                <i class="fas fa-arrow-alt-circle-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </form> --}}
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