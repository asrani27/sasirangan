@extends('layouts.app')
@push('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@push('css')


@endpush
@section('title')
<h4 class="page-title">Stok Bahan Di {{$pasar->nama}} Kota Banjarmasin</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Stok Bahan Pokok {{$pasar->nama}}Kota Banjarmasin</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            
            <div class="btn-toolbar p-3" role="toolbar">
                <div class="col-md-12">
                <form method="get" action="/input/stok/month/{{$id}}">
                    @csrf
                    {{-- <div class="btn-group">
                        <a href="/input/stok" class="btn btn-secondary waves-light waves-effect"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                    </div> --}}
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
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                </div>
                
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr class="text-center">
                        <th rowspan=2>No</th>
                        <th rowspan=2>Nama Bahan</th>
                        <th rowspan=2>Satuan</th>     
                        @if ($week == 5)
                        <th colspan=5>Bulan {{\Carbon\Carbon::CreateFromFormat('m-Y', $month.'-'.$year)->format('M Y')}}</th>  
                        @else
                        <th colspan=4>Bulan {{\Carbon\Carbon::CreateFromFormat('m-Y', $month.'-'.$year)->format('M Y')}}</th>  
                        @endif                         
                    </tr>
                    <tr class="text-center">
                        <th>Minggu Ke 1</th>
                        <th>Minggu Ke 2</th>
                        <th>Minggu Ke 3</th>
                        <th>Minggu Ke 4</th>
                        @if ($week == 5)
                        <th>Minggu Ke 5</th>
                        @endif
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
                                <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text"  data-pasar_id="{{$id}}" data-pk="{{$b->id}}" data-minggu="1" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$b->minggu_1}}</a></td>
                                <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text"  data-pasar_id="{{$id}}" data-pk="{{$b->id}}" data-minggu="2" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$b->minggu_2}}</a></td>
                                <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text"  data-pasar_id="{{$id}}" data-pk="{{$b->id}}" data-minggu="3" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$b->minggu_3}}</a></td>
                                <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text"  data-pasar_id="{{$id}}" data-pk="{{$b->id}}" data-minggu="4" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$b->minggu_4}}</a></td>
                                @if ($week == 5)

                                <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text"  data-pasar_id="{{$id}}" data-pk="{{$b->id}}" data-minggu="5" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$b->minggu_5}}</a></td>
                            
                                @endif
                                {{-- @if (count($b->stok_kota) == 0)
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="1" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="2" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="3" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="4" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    
                                    @if ($week == 5)
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="5" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    @endif
                                @else    
                                    @foreach ($b->stok_kota as $sk)    
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="1" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_1 == null ? '0': $sk->minggu_1}}</a></td>
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="2" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_2 == null ? '0': $sk->minggu_2}}</a></td>
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="3" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_3 == null ? '0': $sk->minggu_3}}</a></td>
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="4" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_4 == null ? '0': $sk->minggu_4}}</a></td>
                                        
                                        @if ($week == 5)
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="5" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_5 == null ? '0': $sk->minggu_5}}</a></td>
                                        @endif
                                    @endforeach
                                @endif --}}
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($fullmonth == false)
                
            {{-- <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr class="text-center">
                        <th rowspan=2>No</th>
                        <th rowspan=2>Nama Bahan</th>
                        <th rowspan=2>Satuan</th>     
                        @if ($week == 5)
                        <th colspan=5>Bulan {{\Carbon\Carbon::CreateFromFormat('m-Y', $month.'-'.$year)->format('M Y')}}</th>  
                        @else
                        <th colspan=4>Bulan {{\Carbon\Carbon::CreateFromFormat('m-Y', $month.'-'.$year)->format('M Y')}}</th>  
                        @endif                         
                    </tr>
                    <tr class="text-center">
                        <th>Minggu Ke 1</th>
                        <th>Minggu Ke 2</th>
                        <th>Minggu Ke 3</th>
                        <th>Minggu Ke 4</th>
                        @if ($week == 5)
                        <th>Minggu Ke 5</th>
                        @endif
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
                                @if (count($b->stok_kota) == 0)
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="1" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="2" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="3" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="4" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    
                                    @if ($week == 5)
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="5" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    @endif
                                @else    
                                    @foreach ($b->stok_kota as $sk)    
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="1" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_1 == null ? '0': $sk->minggu_1}}</a></td>
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="2" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_2 == null ? '0': $sk->minggu_2}}</a></td>
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="3" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_3 == null ? '0': $sk->minggu_3}}</a></td>
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="4" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_4 == null ? '0': $sk->minggu_4}}</a></td>
                                        
                                        @if ($week == 5)
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="5" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_5 == null ? '0': $sk->minggu_5}}</a></td>
                                        @endif
                                    @endforeach
                                @endif
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> --}}
            @else
                
            {{-- <div class="card-body table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                    <tr class="text-center">
                        <th rowspan=2>No</th>
                        <th rowspan=2>Nama Bahan</th>
                        <th rowspan=2>Satuan</th>     
                        
                        @if ($week == 5)
                        <th colspan=5>Bulan {{\Carbon\Carbon::CreateFromFormat('m-Y', $month.'-'.$year)->format('M Y')}}</th>  
                        @else
                        <th colspan=4>Bulan {{\Carbon\Carbon::CreateFromFormat('m-Y', $month.'-'.$year)->format('M Y')}}</th>  
                        @endif                      
                    </tr>
                    <tr class="text-center">
                        <th>Minggu Ke 1</th>
                        <th>Minggu Ke 2</th>
                        <th>Minggu Ke 3</th>
                        <th>Minggu Ke 4</th>
                        @if ($week == 5)
                        <th>Minggu Ke 5</th>
                        @endif
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
                                @if (count($b->stok_kota) == 0)
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="1" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="2" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="3" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="4" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    @if ($week == 5)
                                    <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="5" data-bulan="{{$month}}" data-tahun="{{$year}}">0</a></td>
                                    @endif
                                @else    
                                    @foreach ($b->stok_kota as $sk)    
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="1" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_1 == null ? '0': $sk->minggu_1}}</a></td>
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="2" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_2 == null ? '0': $sk->minggu_2}}</a></td>
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="3" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_3 == null ? '0': $sk->minggu_3}}</a></td>
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="4" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_4 == null ? '0': $sk->minggu_4}}</a></td>
                                        @if ($week == 5)
                                        <td style="padding:5px 12px;"><a href="#" class="inline-username2" data-type="text" data-pk="{{$b->id}}" data-minggu="5" data-bulan="{{$month}}" data-tahun="{{$year}}">{{$sk->minggu_5 == null ? '0': $sk->minggu_5}}</a></td>
                                        @endif
                                    @endforeach
                                @endif
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> --}}
            @endif
            <div class="text-center">

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush