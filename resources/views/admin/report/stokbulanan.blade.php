@extends('layouts.app')
@push('meta')

@endpush
@push('css')


@endpush
@section('title')
<h4 class="page-title">Stok Bulanan Bahan Pokok</h4>
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
                    <form method="get" action="/report/stok/bulanan/search">
                        <div class="btn-group">
                            <select class="form-control" name="bulan" required>
                                <option value="">-Bulan-</option>
                                <option value="01" {{$month=='01' ? 'selected' : '' }}>Januari</option>
                                <option value="02" {{$month=='02' ? 'selected' : '' }}>Februari</option>
                                <option value="03" {{$month=='03' ? 'selected' : '' }}>Maret</option>
                                <option value="04" {{$month=='04' ? 'selected' : '' }}>April</option>
                                <option value="05" {{$month=='05' ? 'selected' : '' }}>Mei</option>
                                <option value="06" {{$month=='06' ? 'selected' : '' }}>Juni</option>
                                <option value="07" {{$month=='07' ? 'selected' : '' }}>Juli</option>
                                <option value="08" {{$month=='08' ? 'selected' : '' }}>Agustus</option>
                                <option value="09" {{$month=='09' ? 'selected' : '' }}>September</option>
                                <option value="10" {{$month=='10' ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{$month=='11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{$month=='12' ? 'selected' : '' }}>Desember</option>
                            </select>
                            &nbsp;
                            <select class="form-control" name="tahun" required>
                                <option value="">-Tahun-</option>
                                <option value="2021" {{$year=='2021' ? 'selected' : '' }}>2021</option>
                                <option value="2022" {{$year=='2022' ? 'selected' : '' }}>2022</option>
                                <option value="2023" {{$year=='2023' ? 'selected' : '' }}>2023</option>
                                <option value="2024" {{$year=='2024' ? 'selected' : '' }}>2024</option>
                                <option value="2025" {{$year=='2025' ? 'selected' : '' }}>2025</option>
                                <option value="2026" {{$year=='2026' ? 'selected' : '' }}>2026</option>
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
                            <th>Stok Bulan Lalu<br>
                                {{\Carbon\Carbon::createFromFormat('m-Y', $month.'-'.$year)->subMonth()->format('M Y')}}
                            </th>
                            <th>Stok Terkini<br>
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
                            <td style="padding:5px 12px;">{{$b->stok_bulanlalu}}</td>
                            <td style="padding:5px 12px;">{{$b->stok_terkini}}</td>
                            <td style="padding:5px 12px;">{{$b->perubahan}}</td>
                            <td style="padding:5px 12px;">

                                @if ($b->stok_bulanlalu == 0 AND $b->stok_terkini != 0)
                                100 %
                                @elseif($b->stok_terkini == 0 AND $b->stok_bulanlalu == 0)
                                0 %
                                @else
                                {{($b->stok_terkini / $b->stok_bulanlalu) * 100 - 100}} %
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