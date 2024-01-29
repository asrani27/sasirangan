@extends('layouts.app')
@push('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@push('css')


@endpush
@section('title')
<h4 class="page-title">Harga Bahan Di {{$pasar->nama}}</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Harga Bahan Pokok Pada Pasar</li>
</ol>
@endsection

@section('content')
@if ($fulldate == false)
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="btn-toolbar p-3" role="toolbar">
                <div class="col-md-10">
                <form method="get" action="/input/harga/fulldate/{{$pasar->id}}">
                    @csrf
                    <div class="btn-group">
                        <a href="/input/harga" class="btn btn-secondary waves-light waves-effect"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                    </div>
                    <div class="btn-group">
                        <select class="form-control" name="bulan" required>
                        <option value="">-Bulan-</option>
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
                        &nbsp;
                        <select class="form-control" name="tahun" required>
                        <option value="">-Tahun-</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        </select>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                </div>
                {{-- <div class="col-md-2">

                <div class="btn-group">
                    <input type="text" class="form-control" placeholder="Cari"><a href="#" class="btn btn-secondary"><i class="fas fa-search"></i></a>
                </div> 
                </div> --}}
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan</th>
                        <th class="text-center">{{$month->format('d M Y')}}</th>
                        
                    </tr>
                    </thead>
                    @php
                        $no =1;
                    @endphp
                    <tbody>
                        
                        @foreach ($data as $b)
                            <tr style="padding:5px 12px;">
                                <td style="padding:5px 12px;">{{$no++}}</td>
                                <td style="padding:5px 12px;">{{$b->nama}}</td>
                                <td style="padding:5px 12px;">Rp. <a href="#" class="inline-username" data-type="text" data-pk="{{$b->id}}" data-pasar="{{$pasar->id}}" data-tanggal="{{\Carbon\Carbon::today()->format('Y-m-d')}}">{{$b->harga}}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">

            </div>
        </div>
    </div>
</div>
@else

<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="btn-toolbar p-3" role="toolbar">
                <div class="col-md-10">
                <form method="get" action="/input/harga/fulldate/{{$pasar->id}}">
                    @csrf
                    <div class="btn-group">
                        <a href="/input/harga/{{$pasar->id}}" class="btn btn-danger waves-light waves-effect"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                    </div>
                    <div class="btn-group">
                        <select class="form-control" name="bulan" required>
                        <option value="">-Bulan-</option>
                        <option value="01" {{$bulan == '01' ? 'selected' :''}}>Januari</option>
                        <option value="02" {{$bulan == '02' ? 'selected' :''}}>Februari</option>
                        <option value="03" {{$bulan == '03' ? 'selected' :''}}>Maret</option>
                        <option value="04" {{$bulan == '04' ? 'selected' :''}}>April</option>
                        <option value="05" {{$bulan == '05' ? 'selected' :''}}>Mei</option>
                        <option value="06" {{$bulan == '06' ? 'selected' :''}}>Juni</option>
                        <option value="07" {{$bulan == '07' ? 'selected' :''}}>Juli</option>
                        <option value="08" {{$bulan == '08' ? 'selected' :''}}>Agustus</option>
                        <option value="09" {{$bulan == '09' ? 'selected' :''}}>September</option>
                        <option value="10" {{$bulan == '10' ? 'selected' :''}}>Oktober</option>
                        <option value="11" {{$bulan == '11' ? 'selected' :''}}>November</option>
                        <option value="12" {{$bulan == '12' ? 'selected' :''}}>Desember</option>
                        </select>
                        &nbsp;
                        <select class="form-control" name="tahun" required>
                        <option value="">-Tahun-</option>
                        <option value="2021" {{$tahun == '2021' ? 'selected' :''}}>2021</option>
                        <option value="2022" {{$tahun == '2022' ? 'selected' :''}}>2022</option>
                        <option value="2023" {{$tahun == '2023' ? 'selected' :''}}>2023</option>
                        </select>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                </div>
            </div>
            <div class="card-body table-responsive">
                Periode : {{$start->format('M Y')}}
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan</th>
                        @foreach ($date as $d)
                            <th>{{$d->format('d')}}</th>
                        @endforeach
                        
                    </tr>
                    </thead>
                    @php
                        $no =1;
                    @endphp
                    <tbody>
                        
                        @foreach ($data as $b)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$b->nama}}</td>
                            @foreach ($b->tanggal as $key => $s)
                                <td><a href="#" class="inline-username" data-type="text" data-pk="{{$b->id}}" data-pasar="{{$pasar->id}}" data-tanggal="{{$tahun}}-{{$bulan}}-{{$key+1}}">{{$s}}</a></td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('js')

@endpush