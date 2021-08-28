<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>CC Gold - Platform Jual Beli dan Investasi Emas</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assetsHome/images/favicon.svg')}}" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('assetsHome/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assetsHome/css/LineIcons.3.0.css')}}" />
    <link rel="stylesheet" href="{{ asset('assetsHome/css/animate.css')}}" />
    <link rel="stylesheet" href="{{ asset('assetsHome/css/tiny-slider.css')}}" />
    <link rel="stylesheet" href="{{ asset('assetsHome/css/glightbox.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assetsHome/css/dark.css')}}" />

</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
    <header class="header navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="nav-inner">
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.html">
                                <img src="{{ asset('assetsHome/images/logo/logo.svg')}}" alt="Logo">
                            </a>
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a href="#home" aria-label="Toggle navigation">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#fitur" aria-label="Toggle navigation">Fitur</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#promo" aria-label="Toggle navigation">Promo</a>
                                    </li>
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav>
                        <!-- End Navbar -->
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </header>
    <!-- End Header Area -->

    <!-- Start Hero Area -->
    <section id="home" class="hero-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                    <div class="hero-content">
                        <h1 class="wow fadeInUp" data-wow-delay=".2s">
                            Platform Investasi Emas Terpercaya
                        </h1>
                        <p class="wow fadeInUp" data-wow-delay=".4s">Beli Emas dengan mudah hanya dalam genggaman anda. Investasi emas termudah yang pernah anda rasakan. Segera download sekarang</p>
                        <div class="button">
                            <a class="btn" href="{{ asset('assetsHome/app-cc-gold.apk')}}" download>Download App</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Features Area -->
    <div id="fitur" class="features section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Berbagai Fitur Terkini</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Feature-->
                    <div class="single-feature text-center">
                        <img src="{{ asset('assetsHome/images/feature/jual-emas.svg')}}" alt="Fitur">
                        <h3 class="title">Jual Emas</h3>
                        <p class="des">Fitur untuk menjual emas langsung dari aplikasi tanpa perlu datang ke toko</p>
                    </div>
                    <!-- End Single Feature-->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Feature-->
                    <div class="single-feature text-center">
                        <img src="{{ asset('assetsHome/images/feature/beli-emas.svg')}}" alt="Fitur">
                        <h3 class="title">Beli Emas</h3>
                        <p class="des">Beli emas mulai dari pecahan kecil dan tersimpan dalam 1 aplikasi. Emasnya pun dapat dicetak jadi bentuk fisik</p>
                    </div>
                    <!-- End Single Feature-->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Feature-->
                    <div class="single-feature text-center">
                        <img src="{{ asset('assetsHome/images/feature/transfer-emas.svg')}}" alt="Fitur">
                        <h3 class="title">Transfer Emas</h3>
                        <p class="des">Memungkinkan anda untuk memberi hadiah orang tersayang dengan transfer saldo emas anda</p>
                    </div>
                    <!-- End Single Feature-->
                </div>
            </div>
        </div>
    </div>
    <!-- End Features Area -->

    <!-- Start Promo Area -->
    <div id="promo" class="features section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Promo Hari Ini</h2>
                    </div>
                </div>
            </div>
            <div class="row promo">
                <div class="slider-head">
                    <div class=" promo-slider">
                        <div class="single-slider">
                            <img class="img-promo" src="{{ asset('assetsHome/images/promo/promo-1.png')}}" alt="Promo">
                        </div>
                        <div class="single-slider">
                            <img class="img-promo" src="{{ asset('assetsHome/images/promo/promo-2.png')}}" alt="Promo">
                        </div>
                        <div class="single-slider">
                            <img class="img-promo" src="{{ asset('assetsHome/images/promo/promo-3.png')}}" alt="Promo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Promo Area -->


    <!-- Start Footer Area -->
    <footer class="footer section">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="inner-content">
                    <div class="row justify-content-between">
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-about">
                                <div class="logo">
                                    <a href="index.html">
                                        <img src="{{ asset('assetsHome/images/logo/logo.svg')}}" alt="#">
                                    </a>
                                </div>
                                <p>Aplikasi untuk investasi emas paling mudah yang pernah anda rasakan. Start your investment with gold!
                                </p>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Informasi</h3>
                                <ul>
                                    <li class="text-white">Email : hello@ccgold.id</li>
                                    <li class="text-white">Telpon : 0341-4644812</li>
                                    <li class="text-white">HP/Whatsapp : 0812-3456-7890</li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Footer Top -->
        <!-- Start Footer Bottom Area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="inner-content">
                    <div class="text-center text-white">
                        &copy; All rights reserved
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom Area -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-arrow-up-circle"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('assetsHome/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assetsHome/js/wow.min.js')}}"></script>
    <script src="{{ asset('assetsHome/js/tiny-slider.js')}}"></script>
    <script src="{{ asset('assetsHome/js/glightbox.min.js')}}"></script>
    <script src="{{ asset('assetsHome/js/count-up.min.js')}}"></script>
    <script src="{{ asset('assetsHome/js/main.js')}}"></script>

    <script type="text/javascript">
        //========= Promo Slider
        tns({
            container: '.promo-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        });
    </script>
</body>

</html>
