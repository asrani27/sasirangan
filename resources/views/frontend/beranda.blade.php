@extends('layouts.app')

@section('title')
<h4 class="page-title">Beranda</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">SELAMAT DATANG DI SARANA INFORMASI HARGA PANGAN KOTA BANJARMASIN</li>
</ol>
@endsection

@section('content')
    
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="card-body">
                <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach ($slider as $key => $item)
                        <div class="carousel-item {{$key == 0 ? 'active':''}}">
                            <img src="/storage/{{$item->file}}" alt="..." width="100%" height="450px">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{$item->judul}}</h5>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaption" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaption" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- end row -->

<h4 class="m-t-20 m-b-30">Berita Terbaru</h4>
<div class="row">
    @foreach ($berita as $b)
        
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            @if ($b->file == null)
            <img class="card-img-top img-fluid" src="/theme/assets/images/small/img-1.jpg" alt="Card image cap">                
            @else
            <img class="card-img-top img-fluid" src="/storage/{{$b->file}}" alt="Card image cap" width="800px" height="533px">                
            @endif
            <div class="card-body">
                <h4 class="card-title font-16 mt-0">{{$b->judul}}</h4>
                <p class="card-text">{{Str::limit($b->isi,250)}}</p>
                <a href="#" class="btn btn-primary waves-effect waves-light">Selengkapnya...</a>
            </div>
        </div>
    </div>
    @endforeach
    
</div>
<!-- end row -->
@endsection