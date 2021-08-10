@extends('layouts.app')
@push('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@push('css')


@endpush
@section('title')
<h4 class="page-title">Harga Rata-Rata Bulanan Bahan Pokok</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active"></li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            
            <div class="btn-toolbar p-3" role="toolbar">
                <div class="col-md-12">
                <form method="get" action="/report/harga/rata-rata/bulanan/search">
                    @csrf
                    <div class="btn-group">
                        <select class="form-control" name="bulan" required>
                        <option value="">-Bulan-</option>
                        <option value="01" {{$month == '01' ? 'selected' : ''}}>Januari</option>
                        <option value="02" {{$month == '02' ? 'selected' : ''}}>Februari</option>
                        <option value="03" {{$month == '03' ? 'selected' : ''}}>Maret</option>
                        <option value="04" {{$month == '04' ? 'selected' : ''}}>April</option>
                        <option value="05" {{$month == '05' ? 'selected' : ''}}>Mei</option>
                        <option value="06" {{$month == '06' ? 'selected' : ''}}>Juni</option>
                        <option value="07" {{$month == '07' ? 'selected' : ''}}>Juli</option>
                        <option value="08" {{$month == '08' ? 'selected' : ''}}>Agustus</option>
                        <option value="09" {{$month == '09' ? 'selected' : ''}}>September</option>
                        <option value="10" {{$month == '10' ? 'selected' : ''}}>Oktober</option>
                        <option value="11" {{$month == '11' ? 'selected' : ''}}>November</option>
                        <option value="12" {{$month == '12' ? 'selected' : ''}}>Desember</option>
                        </select>
                        &nbsp;
                        <select class="form-control" name="tahun" required>
                        <option value="">-Tahun-</option>
                        <option value="2021" {{$year == '2021' ? 'selected' : ''}}>2021</option>
                        <option value="2022" {{$year == '2022' ? 'selected' : ''}}>2022</option>
                        <option value="2023" {{$year == '2023' ? 'selected' : ''}}>2023</option>
                        </select>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>&nbsp;
                        <a href="#" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
                    </div>
                </form>
                </div>
            </div>
            
                
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Bahan</th>
                        <th>Satuan</th>    
                        <th>Hrg. Bulan Lalu (Rp)<br>
                            {{\Carbon\Carbon::createFromFormat('m-Y', $month.'-'.$year)->subMonth()->format('M Y')}}
                        </th>
                        <th>Hrg. Bulan ini (Rp)<br>
                            {{\Carbon\Carbon::createFromFormat('m-Y', $month.'-'.$year)->format('M Y')}}
                        </th>
                        <th>Perubahan (Rp)</th>
                        <th>Perubahan (%)</th>   
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
                                <td style="padding:5px 12px;">{{$b->satuan->nama}}</td>
                                <td style="padding:5px 12px;">Rp. {{number_format($b->bulanLalu)}}</td>
                                <td style="padding:5px 12px;">Rp. {{number_format($b->bulanIni)}}</td>
                                <td style="padding:5px 12px;">Rp. {{number_format($b->perubahan)}}</td>
                                <td style="padding:5px 12px;">
                                
                                    @if ($b->bulanLalu == 0 AND $b->bulanIni != 0) 
                                        100 %
                                    @elseif($b->bulanIni == 0 AND $b->bulanLalu == 0)
                                    0 %
                                    @else
                                    {{round(($b->bulanIni / $b->bulanLalu) * 100 - 100, 2)}} %
                                    @endif
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush