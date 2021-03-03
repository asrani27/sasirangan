@extends('layouts.app')

@section('title')
<h4 class="page-title">Administrator</h4>
<ol class="breadcrumb">
    <li class="breadcrumb-item active">SELAMAT DATANG DI HALAMAN ADMINISTRATOR</li>
</ol>
@endsection

@section('content')


<div class="row">
    <div class="col-xl-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-8 border-right">
                        <h4 class="mt-0 header-title mb-4">Statistik Visitor</h4>
                        <div id="morris-area-example" class="dashboard-charts morris-charts"></div>
                    </div>
                    <div class="col-xl-4">
                        <h4 class="header-title mb-4">Report Visitor Tahunan</h4>
                        <div class="p-3">
                            <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-first-tab" data-toggle="pill" href="#pills-first" role="tab" aria-controls="pills-first" aria-selected="true">2015</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-second-tab" data-toggle="pill" href="#pills-second" role="tab" aria-controls="pills-second" aria-selected="false">2016</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-third-tab" data-toggle="pill" href="#pills-third" role="tab" aria-controls="pills-third" aria-selected="false">2017</a>
                                </li>
                            </ul>
                            
                            <div class="tab-content">
                                <div class="tab-pane show active" id="pills-first" role="tabpanel" aria-labelledby="pills-first-tab">
                                    <div class="p-3">
                                        <h2>17.562</h2>
                                        <p class="text-muted">Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus Nullam quis ante.</p>
                                        <a href="#" class="text-primary">Read more...</a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pills-second" role="tabpanel" aria-labelledby="pills-second-tab">
                                    <div class="p-3">
                                        <h2>18.614</h2>
                                        <p class="text-muted">Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus Nullam quis ante.</p>
                                        <a href="#" class="text-primary">Read more...</a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pills-third" role="tabpanel" aria-labelledby="pills-third-tab">
                                    <div class="p-3">
                                        <h2>19.752</h2>
                                        <p class="text-muted">Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus Nullam quis ante.</p>
                                        <a href="#" class="text-primary">Read more...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
    <!-- end col -->
    
    <div class="col-xl-3">
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title mb-4">Analisis Pasar</h4>
                <div id="morris-donut-example" class="dashboard-charts morris-charts"></div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection