@extends('layouts.app')

@section('title')
<h4 class="page-title">{{$berita->judul}}</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Kategori : {{$berita->kategori == null ? '-': $berita->kategori->nama}}</li>
</ol>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="text-center">
                    <img class="rounded shadow mr-3" src="/storage/{{$berita->file}}" alt="Generic placeholder image" width="50%" height="300px">
                </div>
                <br/>
                <div class="media-body">
                    {!!$berita->isi!!}
                </div>
                {{-- @foreach ($berita as $item)
                    
                <div class="media m-b-30">
                    @if ($item->file == null)
                    <img class="d-flex align-self-start rounded shadow mr-3" src="/theme/assets/images/users/user-3.jpg" alt="Generic placeholder image" height="64">
                        
                    @else
                        
                    @endif
                    <div class="media-body">
                        <h5 class="mt-0 font-16">{{$item->judul}}</h5>
                        {{Str::limit($item->isi, 225, '...')}}
                        <p><a href="/artikel/{{$item->id}}"><b>Selengkapnya...</b></a></p>
                    </div>
                </div>
                @endforeach --}}
                
            </div>
            
        </div>
    </div>
</div><!--end row-->
@endsection