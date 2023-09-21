<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>DEDIKASI BAIMAN</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        @stack('meta')
        @include('layouts.css')
        @toastr_css
    </head>

    <body>
        <!-- Navigation Bar-->
        <header id="topnav">
            @include('layouts.navbar')
            
            @include('layouts.menu')
        </header>
        <!-- End Navigation Bar-->

        <!-- page wrapper start -->
        <div class="wrapper">
            <div class="page-title-box">
                <div class="container-fluid">                    
                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <div class="state-information d-none d-sm-block">
                                <div class="state-graph">
                                    <div id="header-chart-1"></div>
                                    <div class="info">Balance $ 2,317</div>
                                </div>
                                <div class="state-graph">
                                    <div id="header-chart-2"></div>
                                    <div class="info">Item Sold 1230</div>
                                </div>
                            </div> --}}
                            
                            
                            @yield('title')

                        </div>
                    </div>
                </div>
            </div>
            <!-- page-title-box -->
            <div class="page-content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- page wrapper end -->
        @include('layouts.footer')        

        <!-- End Footer -->
        @include('layouts.js')        
        @toastr_js
        @toastr_render
        @stack('js')
    </body>
</html>
