
<div class="topbar-main">
    <div class="container-fluid">

        <!-- Logo container-->
        <div class="logo">
            
            <a href="#" class="logo" style="color:white;font-size=24px;">
                <img src="/theme/bjm.png" alt="" class="logo-small">
                <img src="/theme/bjm.png" alt="" class="logo-large">
                DEDIKASI BAIMAN
            </a>

        </div>
        <div class="menu-extras topbar-custom">

            <ul class="navbar-right d-flex list-inline float-right mb-0">
                
                @if (Auth::check())
                
                <li class="dropdown notification-list">
                    <div class="dropdown notification-list">
                        <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="/theme/assets/images/users/user-4.jpg" alt="user" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="/logout"><i class="mdi mdi-power text-danger"></i> Logout</a>
                        </div>                                                                    
                    </div>
                </li>
                
                @endif
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