<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Burger</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('user/img/favicon.png')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css')}}">
    <!-- <link rel="stylesheet" href="css/responsive.css')}}"> -->
    @yield('styles')
</head>

<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
<!-- header-start -->
<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid p-0">
                <div class="row align-items-center no-gutters">
                    <div class="col-xl-5 col-lg-5">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a  href="{{ url('/') }}">home</a></li>
                                    <li><a href="Menu.html">Menu</a></li>
                                    <li><a class="@yield('activeLocals')" href="{{ route('locals') }}">Locales</a></li>
                                    <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            <li><a href="blog.html">blog</a></li>
                                            <li><a href="single-blog.html">single-blog</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Pages <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            <li><a href="elements.html">elements</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="@yield('activeContact')" href="contact.html">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('user/img/logo.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 d-none d-lg-block">
                        <div class="book_room">
                            <div class="main-menu">
                                <ul >
                                    <!-- Authentication Links -->
                                    @guest
                                        <li><a class="@yield('activeLogin')" href="{{ route('login') }}">Login</a></li>
                                        <li><a class="@yield('activeRegister')" href="{{ route('register') }}">Register</a></li>
                                    @else
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                                {{ Auth::user()->name }} <span class="caret"></span>
                                            </a>

                                            <ul class=" submenu">
                                                <li>
                                                    <a href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    @endguest
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="book_btn d-none d-xl-block">
                                <a class="#" href="#">+10 367 453 7382</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-end -->

<!-- bradcam_area_start -->
@yield('bradcam_area')

<!-- bradcam_area_end -->

<!-- ================ CONTENT SECTION START ================= -->
@yield('content')
<!-- ================ contact SECTION END ================= -->

<!-- footer_start  -->
<footer class="footer">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="footer_widget text-center ">
                        <h3 class="footer_title pos_margin">
                            New York
                        </h3>
                        <p>5th flora, 700/D kings road, <br>
                            green lane New York-1782 <br>
                            <a href="#">info@burger.com</a></p>
                        <a class="number" href="#">+10 378 483 6782</a>

                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="footer_widget text-center ">
                        <h3 class="footer_title pos_margin">
                            California
                        </h3>
                        <p>5th flora, 700/D kings road, <br>
                            green lane New York-1782 <br>
                            <a href="#">info@burger.com</a></p>
                        <a class="number" href="#">+10 378 483 6782</a>

                    </div>
                </div>
                <div class="col-xl-4 col-md-12 col-lg-4">
                    <div class="footer_widget">
                        <h3 class="footer_title">
                            Stay Connected
                        </h3>
                        <form action="#" class="newsletter_form">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit">Sign Up</button>
                        </form>
                        <p class="newsletter_text">Stay connect with us to get exclusive offer!</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="socail_links text-center">
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="ti-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="ti-twitter-alt"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="ti-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right_text">
        <div class="container">
            <div class="footer_border"></div>
            <div class="row">
                <div class="col-xl-12">
                    <p class="copy_right text-center">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer_end  -->

<!-- JS here -->
<script src="{{ asset('user/js/vendor/modernizr-3.5.0.min.js')}}"></script>
<script src="{{ asset('user/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{ asset('user/js/popper.min.js')}}"></script>
<script src="{{ asset('user/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('user/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('user/js/isotope.pkgd.min.js')}}"></script>
<script src="{{ asset('user/js/ajax-form.js')}}"></script>
<script src="{{ asset('user/js/waypoints.min.js')}}"></script>
<script src="{{ asset('user/js/jquery.counterup.min.js')}}"></script>
<script src="{{ asset('user/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{ asset('user/js/scrollIt.js')}}"></script>
<script src="{{ asset('user/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{ asset('user/js/wow.min.js')}}"></script>
<script src="{{ asset('user/js/nice-select.min.js')}}"></script>
<script src="{{ asset('user/js/jquery.slicknav.min.js')}}"></script>
<script src="{{ asset('user/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('user/js/plugins.js')}}"></script>
@yield('scripts')
<!--contact js-->
<script src="{{ asset('user/js/contact.js')}}"></script>
<script src="{{ asset('user/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{ asset('user/js/jquery.form.js')}}"></script>
<script src="{{ asset('user/js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('user/js/mail-script.js')}}"></script>

<script src="{{ asset('user/js/main.js')}}"></script>

</body>

</html>