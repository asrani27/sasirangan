@extends('layouts.app')

@section('title')
<h4 class="page-title">Login</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">Masukkan Username Dan Password</li>
</ol>
@endsection

@section('content')    
<div class="row">
    <div class="col-lg-12">
        <div class="card m-b-20">
            <div class="card-body">

                <form class="" method="post" action="/login">
                    @csrf
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" required placeholder="Username" name="username" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div>
                            <input type="password" id="pass2" class="form-control" required placeholder="Password"  name="password" autocomplete="off">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection