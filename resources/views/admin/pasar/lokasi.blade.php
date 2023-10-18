@extends('layouts.app')
@push('css')
    
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
<style>
    #mapid {
        height: 380px;
    }
</style>
@endpush
@section('title')
<h4 class="page-title">Edit Lokasi Pasar</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Edit Lokasi Pasar</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <form class="" action="/data/pasar/lokasi/{{$edit->id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Pasar</label>
                        <input type="text" class="form-control" name="nama" value="{{$edit->nama}}" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Lat</label>
                        <input type="text" class="form-control" id="lat" name="lat" value="{{$edit->lat}}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Long</label>
                        <input type="text" class="form-control" id="long" name="long" value="{{$edit->long}}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Radius (meter)</label>
                        <input type="text" class="form-control" name="radius" value="{{$edit->radius}}" onkeypress="return hanyaAngka(event)" required>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="/data/pasar" class="btn btn-secondary waves-effect waves-light">
                                <i class="fas fa-arrow-alt-circle-left"></i> Kembali
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
                
        <div id="mapid"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>


<script>
var latlng = {!!json_encode($latlong)!!}
var radius = {!!json_encode($radius)!!}
console.log(radius);
var map = L.map('mapid').setView(latlng, 16);
googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
}).addTo(map);

L.marker([latlng.lat,latlng.lng]).addTo(map);  

var theMarker = {};

map.on('click', function(e) {
    
    document.getElementById("lat").value = e.latlng.lat;
    document.getElementById("long").value = e.latlng.lng;
    
    if (theMarker != undefined) {
        map.removeLayer(theMarker);
    };
    
    theMarker = L.marker([e.latlng.lat,e.latlng.lng]).addTo(map);  
});

var circle = L.circle([latlng.lat,latlng.lng], {
    color:'red',
    fillColor:'#f03',
    fillOpacity:0.5,
    radius:radius
}).addTo(map);
</script>
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
@endpush