<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>DEDIKASI</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="/theme/assets/images/favicon.ico">

    <link rel="stylesheet" href="/theme/plugins/morris/morris.css">

    <link href="/theme/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/theme/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="/theme/assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo container-->
                <div class="logo">

                    <a href="index.html" class="logo">
                        <img src="/theme/assets/images/logo-sm-light.png" alt="" class="logo-small">
                        <img src="/theme/assets/images/logo-light.png" alt="" class="logo-large">
                    </a>

                </div>

                <!-- End Logo container-->


                <div class="menu-extras topbar-custom">

                    <ul class="navbar-right d-flex list-inline float-right mb-0">
                        <li class="dropdown notification-list d-none d-sm-block">
                            <form role="search" class="app-search">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" placeholder="Search..">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light"
                                data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <i class="mdi mdi-bell noti-icon"></i>
                                <span class="badge badge-pill badge-info noti-icon-badge">3</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                <!-- item-->
                                <h6 class="dropdown-item-text">
                                    Notifications (37)
                                </h6>
                                <div class="slimscroll notification-item-list">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                        <p class="notify-details">Your order is placed<span class="text-muted">Dummy
                                                text of the printing and typesetting industry.</span></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                                        <p class="notify-details">New Message received<span class="text-muted">You have
                                                87 unread messages</span></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info"><i class="mdi mdi-flag"></i></div>
                                        <p class="notify-details">Your item is shipped<span class="text-muted">It is a
                                                long established fact that a reader will</span></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                        <p class="notify-details">Your order is placed<span class="text-muted">Dummy
                                                text of the printing and typesetting industry.</span></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
                                        <p class="notify-details">New Message received<span class="text-muted">You have
                                                87 unread messages</span></p>
                                    </a>
                                </div>
                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                                    View all <i class="fi-arrow-right"></i>
                                </a>
                            </div>
                        </li>
                        <li class="dropdown notification-list">
                            <div class="dropdown notification-list">
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user waves-light"
                                    data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <img src="/theme/assets/images/users/user-4.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i>
                                        Profile</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> My Wallet</a>
                                    <a class="dropdown-item d-block" href="#"><span
                                            class="badge badge-success float-right">11</span><i
                                            class="mdi mdi-settings m-r-5"></i> Settings</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5"></i>
                                        Lock screen</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#"><i
                                            class="mdi mdi-power text-danger"></i> Logout</a>
                                </div>
                            </div>
                        </li>

                        <li class="menu-item list-inline-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                    </ul>



                </div>
                <!-- end menu-extras -->

                <div class="clearfix"></div>

            </div> <!-- end container -->
        </div>
        <!-- end topbar-main -->

        <!-- MENU Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">

                        <li class="has-submenu">
                            <a href="index.html"><i class="mdi mdi-home"></i>Dashboard</a>
                        </li>

                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-buffer"></i>UI Elements</a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="ui-alerts.html">Alerts</a></li>
                                        <li><a href="ui-buttons.html">Buttons</a></li>
                                        <li><a href="ui-badge.html">Badge</a></li>
                                        <li><a href="ui-cards.html">Cards</a></li>
                                        <li><a href="ui-carousel.html">Carousel</a></li>
                                        <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <ul>
                                        <li><a href="ui-grid.html">Grid</a></li>
                                        <li><a href="ui-images.html">Images</a></li>
                                        <li><a href="ui-modals.html">Modals</a></li>
                                        <li><a href="ui-pagination.html">Pagination</a></li>
                                        <li><a href="ui-popover-tooltips.html">Popover & Tooltips</a></li>
                                        <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <ul>
                                        <li><a href="ui-tabs-accordions.html">Tabs & Accordions</a></li>
                                        <li><a href="ui-typography.html">Typography</a></li>
                                        <li><a href="ui-video.html">Video</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-black-mesa"></i>Components</a>
                            <ul class="submenu">
                                <li><a href="components-lightbox.html">Lightbox</a></li>
                                <li><a href="components-rangeslider.html">Range Slider</a></li>
                                <li><a href="components-session-timeout.html">Session Timeout</a></li>
                                <li><a href="components-sweet-alert.html">Sweet-Alert</a></li>

                                <li>
                                    <a href="calendar.html">Calendar</a>
                                </li>
                                <li class="has-submenu">
                                    <a href="#">Tables</a>
                                    <ul class="submenu">
                                        <li><a href="tables-basic.html">Basic Tables</a></li>
                                        <li><a href="tables-datatable.html">Data Table</a></li>
                                        <li><a href="tables-responsive.html">Responsive Table</a></li>
                                        <li><a href="tables-editable.html">Editable Table</a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu">
                                    <a href="#">Icons</a>
                                    <ul class="submenu">
                                        <li><a href="icons-material.html">Material Design</a></li>
                                        <li><a href="icons-ion.html">Ion Icons</a></li>
                                        <li><a href="icons-fontawesome.html">Font Awesome</a></li>
                                        <li><a href="icons-themify.html">Themify Icons</a></li>
                                        <li><a href="icons-dripicons.html">Dripicons</a></li>
                                        <li><a href="icons-typicons.html">Typicons Icons</a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu">
                                    <a href="#">Maps</a>
                                    <ul class="submenu">
                                        <li><a href="maps-google.html"> Google Map</a></li>
                                        <li><a href="maps-vector.html"> Vector Map</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-clipboard"></i>Forms</a>
                            <ul class="submenu">
                                <li><a href="form-elements.html">Form Elements</a></li>
                                <li><a href="form-validation.html">Form Validation</a></li>
                                <li><a href="form-advanced.html">Form Advanced</a></li>
                                <li><a href="form-editors.html">Form Editors</a></li>
                                <li><a href="form-uploads.html">Form File Upload</a></li>
                                <li><a href="form-xeditable.html">Form Xeditable</a></li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-finance"></i>Charts</a>
                            <ul class="submenu">
                                <li><a href="charts-chartist.html">Chartist Chart</a></li>
                                <li><a href="charts-chartjs.html">Chartjs Chart</a></li>
                                <li><a href="charts-flot.html">Flot Chart</a></li>
                                <li><a href="charts-c3.html">C3 Chart</a></li>
                                <li><a href="charts-morris.html">Morris Chart</a></li>
                                <li><a href="charts-other.html">Jquery Knob Chart</a></li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-google-pages"></i>Pages</a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="pages-login.html">Login</a></li>
                                        <li><a href="pages-register.html">Register</a></li>
                                        <li><a href="pages-recoverpw.html">Recover Password</a></li>
                                        <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                                        <li><a href="pages-timeline.html">Timeline</a></li>
                                        <li><a href="pages-invoice.html">Invoice</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <ul>
                                        <li><a href="pages-directory.html">Directory</a></li>
                                        <li><a href="pages-blank.html">Blank Page</a></li>
                                        <li><a href="pages-title-2.html">Page Title 2</a></li>
                                        <li><a href="pages-404.html">Error 404</a></li>
                                        <li><a href="pages-500.html">Error 500</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-email"></i>Email</a>
                            <ul class="submenu">
                                <li><a href="email-inbox.html">Inbox</a></li>
                                <li><a href="email-read.html">Email Read</a></li>
                                <li><a href="email-compose.html">Email Compose</a></li>
                            </ul>
                        </li>

                    </ul>
                    <!-- End navigation menu -->
                </div> <!-- end #navigation -->
            </div> <!-- end container -->
        </div> <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->

    <!-- page wrapper start -->
    <div class="wrapper">
        <div class="page-title-box">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="state-information d-none d-sm-block">
                            <div class="state-graph">
                                <div id="header-chart-1"></div>
                                <div class="info">Balance $ 2,317</div>
                            </div>
                            <div class="state-graph">
                                <div id="header-chart-2"></div>
                                <div class="info">Item Sold 1230</div>
                            </div>
                        </div>

                        <h4 class="page-title">Dashboard</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Welcome to Agroxa Dashboard</li>
                        </ol>

                    </div>
                </div>
            </div>
            <!-- end container-fluid -->

        </div>
        <!-- page-title-box -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary mini-stat position-relative">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Orders</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Orders</h6>
                                        <h3 class="mb-3 mt-0">1,587</h3>
                                        <div class="">
                                            <span class="badge badge-light text-info"> +11% </span> <span
                                                class="ml-2">From previous period</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-cube-outline display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary mini-stat position-relative">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Revenue</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Revenue</h6>
                                        <h3 class="mb-3 mt-0">$46,785</h3>
                                        <div class="">
                                            <span class="badge badge-light text-danger"> -29% </span> <span
                                                class="ml-2">From previous period</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-buffer display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary mini-stat position-relative">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Av. Price</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Average Price</h6>
                                        <h3 class="mb-3 mt-0">15.9</h3>
                                        <div class="">
                                            <span class="badge badge-light text-primary"> 0% </span> <span
                                                class="ml-2">From previous period</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-tag-text-outline display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary mini-stat position-relative">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h6 class="text-uppercase verti-label text-white-50">Pr. Sold</h6>
                                    <div class="text-white">
                                        <h6 class="text-uppercase mt-0 text-white-50">Product Sold</h6>
                                        <h3 class="mb-3 mt-0">1890</h3>
                                        <div class="">
                                            <span class="badge badge-light text-info"> +89% </span> <span
                                                class="ml-2">From previous period</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-briefcase-check display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-8 border-right">
                                        <h4 class="mt-0 header-title mb-4">Sales Report</h4>
                                        <div id="morris-area-example" class="dashboard-charts morris-charts"></div>
                                    </div>
                                    <div class="col-xl-4">
                                        <h4 class="header-title mb-4">Yearly Sales Report</h4>
                                        <div class="p-3">
                                            <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="pills-first-tab" data-toggle="pill"
                                                        href="#pills-first" role="tab" aria-controls="pills-first"
                                                        aria-selected="true">2015</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-second-tab" data-toggle="pill"
                                                        href="#pills-second" role="tab" aria-controls="pills-second"
                                                        aria-selected="false">2016</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-third-tab" data-toggle="pill"
                                                        href="#pills-third" role="tab" aria-controls="pills-third"
                                                        aria-selected="false">2017</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="pills-first" role="tabpanel"
                                                    aria-labelledby="pills-first-tab">
                                                    <div class="p-3">
                                                        <h2>$17562</h2>
                                                        <p class="text-muted">Maecenas nec odio et ante tincidunt
                                                            tempus. Donec vitae sapien ut libero venenatis faucibus
                                                            Nullam quis ante.</p>
                                                        <a href="#" class="text-primary">Read more...</a>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="pills-second" role="tabpanel"
                                                    aria-labelledby="pills-second-tab">
                                                    <div class="p-3">
                                                        <h2>$18614</h2>
                                                        <p class="text-muted">Maecenas nec odio et ante tincidunt
                                                            tempus. Donec vitae sapien ut libero venenatis faucibus
                                                            Nullam quis ante.</p>
                                                        <a href="#" class="text-primary">Read more...</a>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="pills-third" role="tabpanel"
                                                    aria-labelledby="pills-third-tab">
                                                    <div class="p-3">
                                                        <h2>$19752</h2>
                                                        <p class="text-muted">Maecenas nec odio et ante tincidunt
                                                            tempus. Donec vitae sapien ut libero venenatis faucibus
                                                            Nullam quis ante.</p>
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
                                <h4 class="mt-0 header-title mb-4">Sales Analytics</h4>
                                <div id="morris-donut-example" class="dashboard-charts morris-charts"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card m-b-20">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-3">Inbox</h4>
                                <div class="inbox-wid">
                                    <a href="#" class="text-dark">
                                        <div class="inbox-item">
                                            <div class="inbox-item-img float-left mr-3"><img
                                                    src="assets/images/users/user-1.jpg" class="thumb-md rounded-circle"
                                                    alt=""></div>
                                            <h6 class="inbox-item-author mt-0 mb-1">Irene</h6>
                                            <p class="inbox-item-text text-muted mb-0">Hey! there I'm available...</p>
                                            <p class="inbox-item-date text-muted">13:40 PM</p>
                                        </div>
                                    </a>
                                    <a href="#" class="text-dark">
                                        <div class="inbox-item">
                                            <div class="inbox-item-img float-left mr-3"><img
                                                    src="assets/images/users/user-2.jpg" class="thumb-md rounded-circle"
                                                    alt=""></div>
                                            <h6 class="inbox-item-author mt-0 mb-1">Jennifer</h6>
                                            <p class="inbox-item-text text-muted mb-0">I've finished it! See you so...
                                            </p>
                                            <p class="inbox-item-date text-muted">13:34 PM</p>
                                        </div>
                                    </a>
                                    <a href="#" class="text-dark">
                                        <div class="inbox-item">
                                            <div class="inbox-item-img float-left mr-3"><img
                                                    src="assets/images/users/user-3.jpg" class="thumb-md rounded-circle"
                                                    alt=""></div>
                                            <h6 class="inbox-item-author mt-0 mb-1">Richard</h6>
                                            <p class="inbox-item-text text-muted mb-0">This theme is awesome!</p>
                                            <p class="inbox-item-date text-muted">13:17 PM</p>
                                        </div>
                                    </a>
                                    <a href="#" class="text-dark">
                                        <div class="inbox-item">
                                            <div class="inbox-item-img float-left mr-3"><img
                                                    src="assets/images/users/user-4.jpg" class="thumb-md rounded-circle"
                                                    alt=""></div>
                                            <h6 class="inbox-item-author mt-0 mb-1">Martin</h6>
                                            <p class="inbox-item-text text-muted mb-0">Nice to meet you</p>
                                            <p class="inbox-item-date text-muted">12:20 PM</p>
                                        </div>
                                    </a>
                                    <a href="#" class="text-dark">
                                        <div class="inbox-item">
                                            <div class="inbox-item-img float-left mr-3"><img
                                                    src="assets/images/users/user-5.jpg" class="thumb-md rounded-circle"
                                                    alt=""></div>
                                            <h6 class="inbox-item-author mt-0 mb-1">Sean</h6>
                                            <p class="inbox-item-text text-muted mb-0">Hey! there I'm available...</p>
                                            <p class="inbox-item-date text-muted">11:47 AM</p>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-5">Recent Activity Feed</h4>
                                <div>
                                    <ul class="nav nav-pills nav-justified recent-activity-tab mb-4"
                                        id="recent-activity-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="activity1-tab" data-toggle="pill"
                                                href="#activity1" role="tab" aria-controls="activity1"
                                                aria-selected="true">21 Sep</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="activity2-tab" data-toggle="pill" href="#activity2"
                                                role="tab" aria-controls="activity2" aria-selected="false">22 Sep</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="activity3-tab" data-toggle="pill" href="#activity3"
                                                role="tab" aria-controls="activity3" aria-selected="false">23 Sep</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="activity4-tab" data-toggle="pill" href="#activity4"
                                                role="tab" aria-controls="activity4" aria-selected="false">24 Sep</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="activity1" role="tabpanel"
                                            aria-labelledby="activity1-tab">
                                            <div class="p-3">
                                                <div class="text-muted">
                                                    <p>21 Sep, 2018</p>
                                                    <h6 class="text-dark">Responded to need “Volunteer Activities”</h6>
                                                    <p>Aenean vulputate eleifend tellus</p>
                                                    <p>Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut
                                                        libero venenatis faucibus Nullam quis ante.</p>
                                                    <a href="#" class="text-primary">Read More...</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="activity2" role="tabpanel"
                                            aria-labelledby="activity2-tab">
                                            <div class="p-3">
                                                <div class="text-muted">
                                                    <p>22 Sep, 2018</p>
                                                    <h6 class="text-dark">Added an interest “Volunteer Activities”</h6>
                                                    <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet
                                                        consectetur velit sed quia non tempora incidunt.</p>
                                                    <p>Ut enim ad minima veniam quis nostrum</p>
                                                    <a href="#" class="text-primary">Read More...</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="activity3" role="tabpanel"
                                            aria-labelledby="activity3-tab">
                                            <div class="p-3">
                                                <div class="text-muted">
                                                    <p>23 Sep, 2018</p>
                                                    <h6 class="text-dark">Joined the group “Boardsmanship Forum”</h6>
                                                    <p>Nemo enim voluptatem quia voluptas</p>
                                                    <p>Donec pede justo fringilla vel aliquet nec vulputate eget arcu.
                                                        In enim justo rhoncus ut imperdiet a venenatis vitae. </p>
                                                    <a href="#" class="text-primary">Read More...</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="activity4" role="tabpanel"
                                            aria-labelledby="activity4-tab">
                                            <div class="p-3">
                                                <div class="text-muted">
                                                    <p>24 Sep, 2018</p>
                                                    <h6 class="text-dark">Attending the event “Some New Event”</h6>
                                                    <p>At vero eos et accusamus et iusto odio</p>
                                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                                        accusantium doloremque laudantium </p>
                                                    <a href="#" class="text-primary">Read More...</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Top product sales</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h6 class="mt-0">Computers</h6>
                                                    <p class="text-muted mb-0">The languages only differ</p>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="peity-pie"
                                                            data-peity='{ "fill": ["#1b82ec", "#f2f2f2"]}'
                                                            data-width="54" data-height="54">70/100</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mt-0">70%</h6>
                                                    <p class="text-muted mb-0">Sales</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6 class="mt-0">Laptops</h6>
                                                    <p class="text-muted mb-0">Maecenas tempus tellus</p>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="peity-donut"
                                                            data-peity='{ "fill": ["#f5b225", "#f2f2f2"], "innerRadius": 20, "radius": 32 }'
                                                            data-width="54" data-height="54">9,4</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mt-0">84%</h6>
                                                    <p class="text-muted mb-0">Sales</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6 class="mt-0">Ipad</h6>
                                                    <p class="text-muted mb-0">Donec pede justo</p>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="peity-pie"
                                                            data-peity='{ "fill": ["#1b82ec", "#f2f2f2"]}'
                                                            data-width="54" data-height="54">62/100</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mt-0">62%</h6>
                                                    <p class="text-muted mb-0">Sales</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6 class="mt-0">Mobile</h6>
                                                    <p class="text-muted mb-0">Aenean leo ligula</p>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="peity-donut"
                                                            data-peity='{ "fill": ["#f5b225", "#f2f2f2"], "innerRadius": 20, "radius": 32 }'
                                                            data-width="54" data-height="54">20,4</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mt-0">89%</h6>
                                                    <p class="text-muted mb-0">Sales</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Latest Trasaction</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">(#) Id</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col" colspan="2">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">#15236</th>
                                                <td>
                                                    <div>
                                                        <img src="assets/images/users/user-2.jpg" alt=""
                                                            class="thumb-md rounded-circle mr-2"> Jeanette James
                                                    </div>
                                                </td>
                                                <td>14/8/2018</td>
                                                <td>$104</td>
                                                <td><span class="badge badge-success">Delivered</span></td>
                                                <td>
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">#15237</th>
                                                <td>
                                                    <div>
                                                        <img src="assets/images/users/user-3.jpg" alt=""
                                                            class="thumb-md rounded-circle mr-2"> Christopher Taylor
                                                    </div>
                                                </td>
                                                <td>15/8/2018</td>
                                                <td>$112</td>
                                                <td><span class="badge badge-warning">Pending</span></td>
                                                <td>
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">#15238</th>
                                                <td>
                                                    <div>
                                                        <img src="assets/images/users/user-4.jpg" alt=""
                                                            class="thumb-md rounded-circle mr-2"> Edward Vazquez
                                                    </div>
                                                </td>
                                                <td>15/8/2018</td>
                                                <td>$116</td>
                                                <td><span class="badge badge-success">Delivered</span></td>
                                                <td>
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">#15239</th>
                                                <td>
                                                    <div>
                                                        <img src="assets/images/users/user-5.jpg" alt=""
                                                            class="thumb-md rounded-circle mr-2"> Michael Flannery
                                                    </div>
                                                </td>
                                                <td>16/8/2018</td>
                                                <td>$109</td>
                                                <td><span class="badge badge-primary">Cancel</span></td>
                                                <td>
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">#15240</th>
                                                <td>
                                                    <div>
                                                        <img src="assets/images/users/user-6.jpg" alt=""
                                                            class="thumb-md rounded-circle mr-2"> Jamie Fishbourne
                                                    </div>
                                                </td>
                                                <td>17/8/2018</td>
                                                <td>$120</td>
                                                <td><span class="badge badge-success">Delivered</span></td>
                                                <td>
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Latest Order</h4>
                                <div class="table-responsive order-table">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">(#) Id</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date/Time</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col" colspan="2">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">#14562</th>
                                                <td>
                                                    <div>
                                                        <img src="assets/images/users/user-4.jpg" alt=""
                                                            class="thumb-md rounded-circle mr-2"> Matthew Drapeau
                                                    </div>
                                                </td>
                                                <td>17/8/2018
                                                    <p class="font-13 text-muted mb-0">8:26AM</p>
                                                </td>
                                                <td>$104</td>
                                                <td><span class="badge badge-success badge-pill"><i
                                                            class="mdi mdi-checkbox-blank-circle text-success"></i>
                                                        Delivered</span></td>
                                                <td>
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">#14563</th>
                                                <td>
                                                    <div>
                                                        <img src="assets/images/users/user-5.jpg" alt=""
                                                            class="thumb-md rounded-circle mr-2"> Ralph Shockey
                                                    </div>
                                                </td>
                                                <td>18/8/2018
                                                    <p class="font-13 text-muted mb-0">10:18AM</p>
                                                </td>
                                                <td>$112</td>
                                                <td><span class="badge badge-warning badge-pill"><i
                                                            class="mdi mdi-checkbox-blank-circle text-warning"></i>
                                                        Pending</span></td>
                                                <td>
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">#14564</th>
                                                <td>
                                                    <div>
                                                        <img src="assets/images/users/user-6.jpg" alt=""
                                                            class="thumb-md rounded-circle mr-2"> Alexander Pierson
                                                    </div>
                                                </td>
                                                <td>18//8/2018
                                                    <p class="font-13 text-muted mb-0">12:36PM</p>
                                                </td>
                                                <td>$116</td>
                                                <td><span class="badge badge-success badge-pill"><i
                                                            class="mdi mdi-checkbox-blank-circle text-success"></i>
                                                        Delivered</span></td>
                                                <td>
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">#14565</th>
                                                <td>
                                                    <div>
                                                        <img src="assets/images/users/user-7.jpg" alt=""
                                                            class="thumb-md rounded-circle mr-2"> Robert Rankin
                                                    </div>
                                                </td>
                                                <td>19/8/2018
                                                    <p class="font-13 text-muted mb-0">11:47AM</p>
                                                </td>
                                                <td>$109</td>
                                                <td><span class="badge badge-primary badge-pill"><i
                                                            class="mdi mdi-checkbox-blank-circle text-primary"></i>
                                                        Cancel</span></td>
                                                <td>
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">#14566</th>
                                                <td>
                                                    <div>
                                                        <img src="assets/images/users/user-8.jpg" alt=""
                                                            class="thumb-md rounded-circle mr-2"> Myrna Shields
                                                    </div>
                                                </td>
                                                <td>20/8/2018
                                                    <p class="font-13 text-muted mb-0">02:52PM</p>
                                                </td>
                                                <td>$120</td>
                                                <td><span class="badge badge-success badge-pill"><i
                                                            class="mdi mdi-checkbox-blank-circle text-success"></i>
                                                        Delivered</span></td>
                                                <td>
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page content-->

    </div>
    <!-- page wrapper end -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    2018 © Agroxa <span class="d-none d-sm-inline-block"> - Crafted with <i
                            class="mdi mdi-heart text-danger"></i> by Themesbrand</span>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->


    <!-- jQuery  -->
    <script src="/theme/assets/js/jquery.min.js"></script>
    <script src="/theme/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/theme/assets/js/jquery.slimscroll.js"></script>
    <script src="/theme/assets/js/waves.min.js"></script>

    <script src="/theme/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

    <!-- Peity JS -->
    <script src="/theme/plugins/peity/jquery.peity.min.js"></script>

    <script src="/theme/plugins/morris/morris.min.js"></script>
    <script src="/theme/plugins/raphael/raphael-min.js"></script>

    <script src="/theme/assets/pages/dashboard.js"></script>

    <!-- App js -->
    {{-- <script src="/assets/js/app.js"></script> --}}

</body>

</html>