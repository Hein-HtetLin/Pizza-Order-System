<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{asset('user/lib/font/css/all.min.css')}}" rel="stylesheet">
    {{-- <link href='{{asset("admin/vendor/font-awesome-4.7/css/font-awesome.min.css")}}' rel="stylesheet" media="all"> --}}
    <link href='{{asset("admin/vendor/font-awesome-5/css/fontawesome-all.min.css")}}' rel="stylesheet" media="all">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('user/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('user/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('admin/vendor/bootstrap-5/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href='{{asset("admin/vendor/bootstrap-4.1/bootstrap.min.css")}}' rel="stylesheet" media="all">

    <link href="{{asset('user/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('user/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        {{-- <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">About</a>
                    <a class="text-body mr-3" href="">Contact</a>
                    <a class="text-body mr-3" href="">Help</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user mx-2"></i>{{Auth::user()->name}}</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="d-inline" href="{{route('user#profile')}}">

                                <button class="btn text-center" type="button">Profile</button>
                            </a>
                            <a href="{{route('pwd#changePage')}}">

                                <button class="btn text-start" type="button">Change Password</button>
                            </a>
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button class="btn btn-dark text-start" type="submit" style="width: 100%"><i class="fas fa-key m-2 text-white"></i>LogOut</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div> --}}
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-3 offset-4 d-flex justify-content-end align-items-center">
                <div class="mx-2">
                    <div class="image rounded-circle">
                        @if (Auth::user()->image == null && Auth::user()->gender == 'male')
                        <img class="rounded-circle shadow object-fill" style="width: 60px; height:60px"  src="{{asset('admin/images/default-male.png')}}" alt="">
                        @elseif (Auth::user()->image == null && Auth::user()->gender == 'female')
                        <img class="rounded-circle shadow object-fill" style="width: 60px; height:60px"  src="{{asset('admin/images/default-female.jpg')}}" alt="">
                        @else
                        <img class="rounded-circle shadow object-fill" style="width: 60px; height:60px" src="{{asset('storage/'.Auth::user()->image)}}">
                        @endif

                    </div>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle cursor-pointer text-dark text-decoration-none" href="#" data-toggle="dropdown" aria-expanded="false">
                      {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{route('user#profile')}}">

                                <button class="btn text-center" type="button">Profile</button>
                            </a>

                        </li>
                        <li class="dropdown-item">
                            <a href="{{route('pwd#changePage')}}">

                                <button class="btn text-start" type="button">Change Password</button>
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button class="btn btn-dark text-start" type="submit" style="width: 100%"><i class="fas fa-key m-2 text-white"></i>LogOut</button>
                            </form>
                        </li>
                    </ul>
                  </div>
            </div>
            </div>

    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row d-flex justify-content-center px-xl-5 mx-auto">

            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{route('user#home')}}" class="nav-item nav-link active">Home</a>
                        </div>

                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Breadcrumb Start -->
    {{-- <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div> --}}
    <!-- Breadcrumb End -->

    @yield('content')


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{asset('user/img/payments.png')}}" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>



    <!-- JavaScript Libraries -->
    <script src='{{asset("user/lib/jquery-3.2.1.min.js")}}'></script>
    <script src='{{asset("user/lib/bootstrap-4.1/popper.min.js")}}'></script>
    <script src='{{asset("user/lib/bootstrap-5/js/bootstrap.min.js")}}'></script>
    <script src='{{asset("user/lib/bootstrap-4.1/bootstrap.min.js")}}'></script>
    <script src='{{asset("user/lib/easing/easing.min.js")}}'></script>
    <script src="{{asset('user/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('user/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('user/mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src='{{asset("user/js/main.js")}}'></script>
    @yield('script')
</body>

</html>
