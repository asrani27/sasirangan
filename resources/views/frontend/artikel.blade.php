@extends('layouts.app')

@section('title')
<h4 class="page-title">Artikel</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Artikel</li>
</ol>
@endsection

@push('css')
@include('frontend.cssaduan')
@endpush
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                @foreach ($berita as $item)
                    
                <div class="media m-b-30">
                    @if ($item->file == null)
                    <img class="d-flex align-self-start rounded shadow mr-3" src="/theme/assets/images/users/user-3.jpg" alt="Generic placeholder image" height="64">
                        
                    @else
                    <img class="d-flex align-self-start rounded shadow mr-3" src="/storage/{{$item->file}}" alt="Generic placeholder image" height="64">
                        
                    @endif
                    <div class="media-body">
                        <h5 class="mt-0 font-16">{{$item->judul}}</h5>
                        {{Str::limit($item->isi, 225, '...')}}
                        <p><a href="/artikel/{{$item->id}}"><b>Selengkapnya...</b></a></p>
                    </div>
                </div>
                @endforeach
                
            </div>
            {{$berita->links()}}
        </div>
    </div>
</div><!--end row-->

@include('frontend.aduan')
@endsection