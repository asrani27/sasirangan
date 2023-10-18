@extends('layouts.app')

@section('title')
<h4 class="page-title">Edit Nomor Aduan</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Edit Nomor Aduan</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <form class="" action="/data/nomoraduan/" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nomor Aduan</label>
                        <input type="text" class="form-control" name="nomor" value="{{$data == null ? '': $data->nomor}}" onkeypress="return hanyaAngka(event)" required>
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </div>
                    </div>
                </form>
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