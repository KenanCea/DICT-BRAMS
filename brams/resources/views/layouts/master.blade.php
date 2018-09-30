<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BRAMS</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        <nav class="main-header navbar navbar-expand fixed-top bg-white navbar-light border-bottom">
            <ul class="navbar-nav">
                <li class="nav-item"> <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a> </li>
            </ul>
            <form class="form-inline ml-3">
                <div class="input-group">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit"> <i class="fa fa-search"></i> </button>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#"> <i class="fas fa-bell" style="font-size:20px"></i>
                        <span class="badge badge-danger navbar-badge" style="font-size:9px; border-radius:50%;">3</span></a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"> <i class="fa fa-envelope mr-2"></i> 4 new messages <span class="float-right text-muted text-sm">3 mins</span> </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"> <i class="fas fa-users mr-2"></i> 8 friend requests <span class="float-right text-muted text-sm">12 hours</span> </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"> <i class="fa fa-file mr-2"></i> 3 new reports <span class="float-right text-muted text-sm">2 days</span> </a>
                        <div class="dropdown-divider"></div> <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link p-0" data-toggle="dropdown" href="#">
                        <div class="user-panel d-flex">
                            <div class="info"> {{ Auth::user()->name }} <i class="right fa fa-angle-down"></i></div>
                            <div class="image"> <img src="/img/profile.png" alt="User Image"> </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> <a href="#" class="dropdown-item"> Status: Online <i class="fas fa-circle green ml-2"></i></a>
                        <div class="dropdown-divider"></div>
                        <router-link to="/account" class="dropdown-item"> <i class="fas fa-user mr-2"></i> Account Info </router-link>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
                        <router-link to="/profile" class="dropdown-item"> <i class="fas fa-map mr-2"></i> Barangay Profile </router-link>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }} </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                    </div>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-blue-primary elevation-4">
            <router-link to="/home" class="brand-link"> <img src="/img/logo.png" alt="BRAMS Logo" class="brand-image img-circle elevation-3"> <span class="brand-text font-weight-bold">B.R.A.M.S</span> </router-link>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @can('isUser')
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
                                    <router-link to="/businessclearance" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Business Clearance</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/barangaycertificate" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Barangay Certificate</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/garagecertificate" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Garage Certificate</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/barangayidcard" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Barangay ID Card</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/filedcases" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Filed Cases</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link"> <i class="nav-icon fas fa-book"></i>
                                <p> Documents <i class="right fa fa-angle-left"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/resolutions" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Resolutions</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/memorandum" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Memorandum</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/minofmeeting" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Min of Meeting</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/ecologicalprofileform" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Ecological Profile Form</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/barangayclearancelist" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Barangay Clearance List</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/businessclearancelist" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Business Clearance List</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/certification" class="nav-link"> <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Certification</p>
                                    </router-link>
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
                        @endcan
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            <div class="container-fluid mt-lg-5 pt-3">
                <router-view></router-view>
                <vue-progress-bar></vue-progress-bar>
            </div>
        </div>
        <footer class="main-footer"> <strong>Copyright &copy; 2018.</strong> All rights reserved. </footer>
    </div>
    <script src="/js/app.js"></script>
</body>

</html>
