@extends('layouts.app')

@section('title')
<h4 class="page-title">Ganti Password</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Ganti Password Superadmin</li>
</ol>
@endsection

@section('content')


<div class="row">
    
    <div class="col-lg-6">
        <div class="card m-b-20">
            <div class="card-body">
                <form class="" action="/data/gantipassword" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="{{Auth::user()->name}}" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="text" class="form-control" name="password" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Masukkan Password Lagi</label>
                        <input type="text" class="form-control" name="password2" required>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection