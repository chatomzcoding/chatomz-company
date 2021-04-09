@php
    $infowebsite = App\Models\Infowebsite::first(); 
@endphp

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

  <link rel="shortcut icon" href="{{ asset('/img/cc.png')}}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('/template/ogani/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/template/ogani/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/template/ogani/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/template/ogani/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/template/ogani/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/template/ogani/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/template/ogani/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/template/ogani/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/style.css')}}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="{{ url('/')}}"><img src="{{ asset('/img/admin/info/'.$infowebsite->logo_brand)}}" alt="" width="150px"></a>
        </div>
        <div class="humberger__menu__cart">
            {{-- <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul> --}}
            @if (Auth::user())
                <div class="header__cart__price"><i class="fa fa-user"></i> <span>{{ Auth::user()->name}}</span></div>
            @else
                <div class="header__cart__price"><i class="fa fa-user"></i> <span>Konsumen</span></div>
            @endif
        </div>
        <div class="humberger__menu__widget">
            {{-- <div class="header__top__right__language">
                <img src="{{ asset('/template/ogani/img/language.png')}}" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div> --}}
            <div class="header__top__right__auth">
                @if (Auth::user())
                    <a href="{{ url('/dashboard')}}"><i class="fa fa-file"></i> Dashboard</a>
                @else
                    <a href="{{ url('/login')}}"><i class="fa fa-user"></i> Masuk</a>
                @endif
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{ url('/')}}">Beranda</a></li>
                {{-- <li><a href="{{ url('/view/shop-grid')}}">Belanja</a></li> --}}
                {{-- <li><a href="#">Halaman</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="{{ url('/view/shop-detail')}}">Shop Details</a></li>
                        <li><a href="{{ url('/view/cart')}}">Shoping Cart</a></li>
                        <li><a href="{{ url('/view/checkout')}}">Check Out</a></li>
                        <li><a href="{{ url('/view/blog-detail')}}">Blog Details</a></li>
                    </ul>
                </li> --}}
                <li><a href="{{ url('/h/blog')}}">Blog</a></li>
                {{-- <li><a href="{{ url('/view/contact')}}">Kontak</a></li> --}}
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> {{ $infowebsite->email}}</li>
                <li>{{ $infowebsite->teks_atas}}</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> {{ $infowebsite->email}}</li>
                                <li>{{ $infowebsite->teks_atas}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                @if (!is_null($infowebsite->link_fb))
                                    <a href="{{ $infowebsite->link_fb}}" target="_blank"><i class="fa fa-facebook"></i></a>
                                @endif
                                @if (!is_null($infowebsite->link_tw))
                                    <a href="{{ $infowebsite->link_tw}}" target="_blank"><i class="fa fa-twitter"></i></a>
                                @endif
                                @if (!is_null($infowebsite->link_in))
                                    <a href="{{ $infowebsite->link_in}}" target="_blank"><i class="fa fa-linkedin"></i></a>
                                @endif
                                @if (!is_null($infowebsite->link_pi))
                                    <a href="{{ $infowebsite->link_pi}}" target="_blank"><i class="fa fa-pinterest-p"></i></a>
                                @endif
                            </div>
                            {{-- <div class="header__top__right__language">
                                <img src="{{ asset('/template/ogani/img/language.png')}}" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div> --}}
                            <div class="header__top__right__auth">
                                @if (Auth::user())
                                    <a href="{{ url('/dashboard')}}"><i class="fa fa-file"></i> Dashboard</a>
                                @else
                                    <a href="{{ url('/login')}}"><i class="fa fa-user"></i> Masuk</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{ url('/')}}"><img src="{{ asset('/img/admin/info/'.$infowebsite->logo_brand)}}" alt="" width="150px"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{ url('/')}}">Beranda</a></li>
                            {{-- <li><a href="{{ url('/view/shop-grid')}}">Belanja</a></li> --}}
                            {{-- <li><a href="#">Halaman</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="{{ url('/view/shop-detail')}}">Shop Details</a></li>
                                    <li><a href="{{ url('/view/cart')}}">Shoping Cart</a></li>
                                    <li><a href="{{ url('/view/checkout')}}">Check Out</a></li>
                                    <li><a href="{{ url('/view/blog-detail')}}">Blog Details</a></li>
                                </ul>
                            </li> --}}
                            <li><a href="{{ url('/h/blog')}}">Blog</a></li>
                            {{-- <li><a href="{{ url('/view/contact')}}">Kontak</a></li> --}}
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            {{-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> --}}
                            {{-- <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li> --}}
                            <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                        </ul>
                        {{-- <div class="header__cart__price">item: <span>$150.00</span></div> --}}
                        <div class="header__cart__price">Mulai Pesan Sekarang !</div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->


    @yield('container')

        <!-- Footer Section Begin -->
        <footer class="footer spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer__about">
                            <div class="footer__about__logo">
                                <a href="{{ url('/')}}"><img src="{{ asset('/img/admin/info/'.$infowebsite->logo_brand)}}" width="150px" alt=""></a>
                            </div>
                            <hr>
                            <dl class="row">
                                <dt class="col-md-4">Alamat</dt>
                                <dd class="col-md-8 small">{{ $infowebsite->alamat}}</dd>
                                <dt class="col-md-4">Telp</dt>
                                <dd class="col-md-8 small">{{ $infowebsite->telp}}</dd>
                                <dt class="col-md-4">Email</dt>
                                <dd class="col-md-8 small">{{ $infowebsite->email}}</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                        <div class="footer__widget">
                            <h6>Ketahui lebih jauh</h6>
                            <div class="footer__widget__social">
                                <a href="{{ $infowebsite->link_fb}}" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="{{ $infowebsite->link_ig}}" target="_blank"><i class="fa fa-instagram"></i></a>
                                <a href="{{ $infowebsite->link_tw}}" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="{{ $infowebsite->link_pi}}" target="_blank"><i class="fa fa-pinterest"></i></a>
                            </div>
                            <ul>
                                <li><a href="https://www.youtube.com/channel/UCNnujqOJv9u-nFCZyY3V89A" target="_blank">Youtube Firman Chatomz</a></li>
                                <li><a href="https://www.youtube.com/channel/UCacBj5kaClfzM5grpiGrqcg" target="_blank">Youtube Chatomz Family</a></li>
                            </ul>
                            <ul>
                                <li><a href="https://cikarastudio.com/wp/" target="_blank">Cikara Studio</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="footer__widget">
                            <h6>Lokasi Kantor</h6>
                            {{-- <p>Get E-mail updates about our latest shop and special offers.</p>
                            <form action="#">
                                <input type="text" placeholder="Enter your mail">
                                <button type="submit" class="site-btn">Berlangganan</button>
                            </form> --}}
                            <section>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1429.8123313334963!2d108.19739095686242!3d-7.301848930790125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f50dc3fc96b95%3A0x983b0a907d6af155!2sGrand%20Sukarindik%20Regency!5e0!3m2!1sid!2sid!4v1617950090492!5m2!1sid!2sid" width="100%" height="200px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </section>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer__copyright">
                            <div class="footer__copyright__text text-center w-100">
                                <p>Copyright &copy; {{ ambil_tahun()}} All rights reserved | Support by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->
    
        <!-- Js Plugins -->
        <script src="{{ asset('/template/ogani/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{ asset('/template/ogani/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('/template/ogani/js/jquery.nice-select.min.js')}}"></script>
        <script src="{{ asset('/template/ogani/js/jquery-ui.min.js')}}"></script>
        <script src="{{ asset('/template/ogani/js/jquery.slicknav.js')}}"></script>
        <script src="{{ asset('/template/ogani/js/mixitup.min.js')}}"></script>
        <script src="{{ asset('/template/ogani/js/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('/template/ogani/js/main.js')}}"></script>
    
    </body>
    
    </html>