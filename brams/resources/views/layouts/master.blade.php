<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>B.R.A.M.S</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/brams.css"> </head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand fixed-top bg-white navbar-light border-bottom">
            <ul class="navbar-nav">
                <li class="nav-item"> <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a> </li>
            </ul>
            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit"> <i class="fa fa-search"></i> </button>
                    </div>
                </div>
            </form>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#"> <i class="fas fa-comments"></i>
                        <!--          <span class="badge badge-danger navbar-badge">3</span>--></a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media"> <img src="/img/user.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media"> <img src="/img/user.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media"> <img src="/img/user.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div> <a href="#" class="dropdown-item dropdown-footer">See All Messages</a> </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#"> <i class="fas fa-bell"></i>
                        <!--          <span class="badge badge-warning navbar-badge">15</span>--></a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"> <i class="fa fa-envelope mr-2"></i> 4 new messages <span class="float-right text-muted text-sm">3 mins</span> </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"> <i class="fas fa-users mr-2"></i> 8 friend requests <span class="float-right text-muted text-sm">12 hours</span> </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"> <i class="fa fa-file mr-2"></i> 3 new reports <span class="float-right text-muted text-sm">2 days</span> </a>
                        <div class="dropdown-divider"></div> <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link p-0" data-toggle="dropdown" href="#">
                        <div class="user-panel d-flex">
                            <div class="info"> {{ Auth::user()->name }} <i class="right fa fa-angle-down"></i></div>
                            <div class="image"> <img src="/img/profile.png" alt="User Image"> </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> <a href="#" class="dropdown-item">  Status: Online <i class="fas fa-circle green ml-2"></i></a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"> <i class="fas fa-sliders-h mr-2"></i> Account Setting </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"> <i class="fas fa-comment-alt mr-2"></i> Feedback </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }} </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-blue-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link"> <img src="/img/logo.png" alt="BRAMS Logo" class="brand-image img-circle elevation-3"> <span class="brand-text font-weight-bold">B.R.A.M.S</span> </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <router-link to="/home" class="nav-link"> <i class="nav-icon fas fa-home"></i>
                                <p> Home </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/dashboard" class="nav-link"> <i class="nav-icon fas fa-chart-bar"></i>
                                <p> Dashboard </p>
                            </router-link>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link"> <i class="nav-icon fas fa-file-alt"></i>
                                <p> Forms <i class="right fa fa-angle-left"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/barangayclearance" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Barangay Clearance</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Business Clearance</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Barangay Certificate</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Garage Certificate</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Barangay ID Card</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Filed Cases</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link"> <i class="nav-icon fas fa-book"></i>
                                <p> Documents <i class="right fa fa-angle-left"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Resolutions</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Memorandum</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Min of Meeting</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Ecological Profile Form</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Barangay Clearance List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Business Clearance List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Certification</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Garage Certificate</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <router-link to="/household" class="nav-link"> <i class="nav-icon fas fa-h-square"></i>
                                <p> Household </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/inhabitant" class="nav-link"> <i class="nav-icon fas fa-users"></i>
                                <p> Inhabitant </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/pet" class="nav-link"> <i class="nav-icon fas fa-paw"></i>
                                <p> Pet Vaccine </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/garbage" class="nav-link"> <i class="nav-icon fas fa-trash"></i>
                                <p> Garbage Fee </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/calendar" class="nav-link"> <i class="nav-icon fas fa-calendar"></i>
                                <p> Calendar </p>
                            </router-link>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid mt-lg-5">
                    <router-view></router-view>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <!-- Default to the left --><strong>Copyright &copy; 2018.</strong> All rights reserved. </footer>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <script src="/js/app.js"></script>
</body>

</html>