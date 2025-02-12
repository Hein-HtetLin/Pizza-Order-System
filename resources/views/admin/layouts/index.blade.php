<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <link rel="shortcut icon" href="{{asset('admin/images/icon/logo-mini.png')}}" type="image/x-icon">


    <!-- Title Page-->
    <title>Cool Admin</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href='{{asset("admin/vendor/font-awesome-4.7/css/font-awesome.min.css")}}' rel="stylesheet" media="all">
    <link href='{{asset("admin/vendor/font-awesome-5/css/fontawesome-all.min.css")}}' rel="stylesheet" media="all">
    <link href='{{asset("admin/vendor/mdi-font/css/material-design-iconic-font.min.css")}}' rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('admin/vendor/bootstrap-5/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href='{{asset("admin/vendor/bootstrap-4.1/bootstrap.min.css")}}' rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href='{{asset("admin/vendor/animsition/animsition.min.css")}}' rel="stylesheet" media="all">
    <link href='{{asset("admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css")}}' rel="stylesheet" media="all">
    <link href='{{asset("admin/vendor/wow/animate.css")}}' rel="stylesheet" media="all">
    <link href='{{asset("admin/vendor/css-hamburgers/hamburgers.min.css")}}' rel="stylesheet" media="all">
    <link href='{{asset("admin/vendor/slick/slick.css")}}' rel="stylesheet" media="all">
    <link href='{{asset("admin/vendor/select2/select2.min.css")}}' rel="stylesheet" media="all">
    <link href='{{asset("admin/vendor/perfect-scrollbar/perfect-scrollbar.css")}}' rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href='{{asset("admin/css/theme.css")}}' rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('admin/images/icon/logo.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{route('category#list')}}">
                                <i class="fas fa-list"></i>Category
                            </a>
                        </li>
                        <li>
                            <a href="{{route('product#list')}}">
                                <i class="fas fa-utensils"></i>Products</a>
                        </li>
                        <li>
                            <a href="{{route('order#list')}}">
                                <i class="fas fa-truck"></i>Orders</a>
                        </li>
                        <li>
                            <a href="{{route('admin#list')}}">
                                <i class="fas fa-user"></i>Admin List</a>
                        </li>
                        <li>
                            <a href="{{route('admin#userList')}}">
                                <i class="fas fa-users"></i>User List</a>
                        </li>
                        <li>
                            <a href="{{route('admin#mail')}}">
                                <i class="fas fa-envelope"></i>User Message</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap d-flex justify-content-end">

                            <div class="header-button">
                                {{-- <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image rounded-circle">
                                            @if (Auth::user()->image == null && Auth::user()->gender == 'male')
                                            <img class="rounded-circle shadow object-fill"  src="{{asset('admin/images/default-male.png')}}" alt="">
                                            @elseif (Auth::user()->image == null && Auth::user()->gender == 'female')
                                            <img class="rounded-circle shadow object-fill"  src="{{asset('admin/images/default-female.jpg')}}" alt="">
                                            @else
                                            <img class="rounded-circle shadow object-fill" src="{{asset('storage/'.Auth::user()->image)}}">
                                            @endif

                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image rounded-circle">
                                                    @if (Auth::user()->image == null && Auth::user()->gender == 'male')
                                                    <img class="rounded-circle shadow object-fit-cover"  src="{{asset('admin/images/default-male.png')}}" alt="">
                                                    @elseif (Auth::user()->image == null && Auth::user()->gender == 'female')
                                                    <img class="rounded-circle shadow"  src="{{asset('admin/images/default-female.jpg')}}" alt="">
                                                    @else
                                                    <img class="rounded-circle shadow object-fit" src="{{asset('storage/'.Auth::user()->image)}}">
                                                    @endif

                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#profile')}}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#changePwdPage')}}">
                                                        <i class="fas fa-key"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer w-full">
                                                <form  class="w-full" action="{{ route('logout')}}" method="post">
                                                    @csrf
                                                    <button class="btn btn-dark w-full text-start" style="width:100%" type="submit"><i class="zmdi zmdi-power me-2"></i>LOGOUT</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            @yield('content')
        </div>
    </div>

    <!-- Jquery JS-->
    <script src='{{asset("admin/vendor/jquery-3.2.1.min.js")}}'></script>
    <!-- Bootstrap JS-->
    <script src='{{asset("admin/vendor/bootstrap-4.1/popper.min.js")}}'></script>
    <script src='{{asset("admin/vendor/bootstrap-4.1/bootstrap.min.js")}}'></script>
    <!-- Vendor JS       -->
    <script src='{{asset("admin/vendor/slick/slick.min.js")}}'>
    </script>
    <script src='{{asset("admin/vendor/wow/wow.min.js")}}'></script>
    <script src='{{asset("admin/vendor/animsition/animsition.min.js")}}'></script>
    <script src='{{asset("admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js")}}'>
    </script>
    <script src='{{asset("admin/vendor/counter-up/jquery.waypoints.min.js")}}'></script>
    <script src='{{asset("admin/vendor/counter-up/jquery.counterup.min.js")}}'>
    </script>
    <script src='{{asset("admin/vendor/circle-progress/circle-progress.min.js")}}'></script>
    <script src='{{asset("admin/vendor/perfect-scrollbar/perfect-scrollbar.js")}}'></script>
    <script src='{{asset("admin/vendor/chartjs/Chart.bundle.min.js")}}'></script>
    <script src='{{asset("admin/vendor/select2/select2.min.js")}}'>
    </script>

    <!-- Main JS-->
    <script src='{{asset("admin/js/main.js")}}'></script>
    @yield('script')

</body>

</html>
<!-- end document-->
