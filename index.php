<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>CepatKirim | Layanan Kirim Paket</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="user/assets/img/favicon.png" rel="icon" />
    <link href="user/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link
        href="user/assets/vendor/bootstrap/css/bootstrap.min.css"
        rel="stylesheet" />
    <link
        href="user/assets/vendor/bootstrap-icons/bootstrap-icons.css"
        rel="stylesheet" />
    <link href="user/assets/vendor/aos/aos.css" rel="stylesheet" />
    <link
        href="user/assets/vendor/glightbox/css/glightbox.min.css"
        rel="stylesheet" />
    <link href="user/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="user/assets/css/main.css" rel="stylesheet" />

    <!-- =======================================================
  * Template Name: CepatKirim
  * Template URL: https://bootstrapmade.com/CepatKirim-bootstrap-business-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">
    <header id="header" class="header sticky-top">
        <div class="topbar d-flex align-items-center">
            <div
                class="container d-flex justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">cepatkirim@gmail.com</a></i>
                    <i class="bi bi-phone d-flex align-items-center ms-4"><span>+62812 3456 7889</span></i>
                </div>
                <div class="social-links d-none d-md-flex align-items-center">
                    <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
        <!-- End Top Bar -->

        <div class="branding d-flex align-items-cente">
            <div
                class="container position-relative d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-center">
                    <h1 class="sitename">
                        Cepat<span class="text-primary">Kirim</span>
                    </h1>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="#hero" class="active">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="login.php"><button class="btn btn-primary rounded-pill px-3">Login</button></a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
            </div>
        </div>
    </header>

    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section light-background">
            <div class="container">
                <div class="row gy-4">
                    <div
                        class="col-lg-7 order-2 order-lg-1 d-flex flex-column justify-content-center"
                        data-aos="zoom-out">
                        <h2 class="fw-bold">
                            Kirim Paket dengan <br />
                            <span style="color: var(--accent-color)">Cepat dan Aman, Tanpa Ribet</span>
                        </h2>
                        <p>Layanan ekspedisi terpercaya untuk segala kebutuhan Anda</p>
                    </div>
                    <div
                        class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center"
                        data-aos="zoom-out">
                        <!-- Card -->
                        <div
                            class="card shadow-sm border-0 rounded-4"
                            style="
                  background: rgba(255, 255, 255, 0.2);
                  backdrop-filter: blur(10px);
                  -webkit-backdrop-filter: blur(10px);
                  border: 1px solid rgba(255, 255, 255, 0.3);
                  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
                ">

                            <div class="card-body">
                                <!-- Cek Status Form -->
                                <form id="statusForm" style="display: block" method="POST" action="packages-details.php">
                                    <div class="mb-3">
                                        <input
                                            type="text"
                                            id="resi"
                                            name="resi"
                                            class="form-control rounded-pill"
                                            placeholder="Masukkan Nomer Resi"
                                            required />
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn btn-primary w-100 rounded-pill">
                                        Lacak
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Hero Section -->

        <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section">
            <div class="container">
                <div class="row gy-4">
                    <div
                        class="col-xl-3 col-md-6 d-flex"
                        data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-stopwatch"></i></div>
                            <h4>
                                <a href="" class="stretched-link">Pengiriman Tepat Waktu</a>
                            </h4>
                            <p>
                                Kami memastikan paket Anda sampai di tujuan dengan cepat dan
                                aman berkat teknologi pelacakan terkini dan jaringan logistik
                                yang luas.
                            </p>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div
                        class="col-xl-3 col-md-6 d-flex"
                        data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-truck"></i>
                            </div>
                            <h4>
                                <a href="" class="stretched-link">Pengiriman Sesuai Kebutuhan</a>
                            </h4>
                            <p>
                                Dapatkan berbagai opsi pengiriman mulai dari Same Day, Next
                                Day, hingga Reguler. Kami selalu siap memenuhi kebutuhan
                                ekspedisi Anda.
                            </p>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div
                        class="col-xl-3 col-md-6 d-flex"
                        data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-globe-central-south-asia"></i>
                            </div>
                            <h4>
                                <a href="" class="stretched-link">Ke Seluruh Nusantara</a>
                            </h4>
                            <p>
                                CepatKirim hadir di lebih dari 500 kota di Indonesia,
                                memastikan jangkauan layanan yang merata dan berkualitas.
                            </p>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div
                        class="col-xl-3 col-md-6 d-flex"
                        data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-broadcast icon"></i></div>
                            <h4>
                                <a href="" class="stretched-link">Kualitas dan Kepuasan Utama</a>
                            </h4>
                            <p>
                                Kami menyediakan layanan pengiriman dengan asuransi dan
                                dukungan pelanggan 24/7, sehingga Anda dapat merasa tenang
                                setiap saat.
                            </p>
                        </div>
                    </div>
                    <!-- End Service Item -->
                </div>
            </div>
        </section>
        <!-- /Featured Services Section -->

        <!-- About Section -->
        <section id="about" class="about section light-background">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tentang Kami</h2>
                <p>
                    <span>Kenali Lebih Dekat </span>
                    <span class="description-title">CepatKirim</span>
                </p>
            </div>
            <!-- End Section Title -->

            <div class="container">
                <div class="row gy-3">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="user/assets/img/about.jpg" alt="" class="img-fluid" />
                    </div>

                    <div
                        class="col-lg-6 d-flex flex-column justify-content-center"
                        data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="about-content ps-0 ps-lg-3">
                            <h3>Siapa Kami?</h3>
                            <p class="">
                                CepatKirim hadir sebagai solusi pengiriman paket cepat, aman,
                                dan terpercaya di seluruh Indonesia. Didukung oleh teknologi
                                canggih dan tim profesional, kami berkomitmen untuk
                                menghadirkan layanan terbaik untuk Anda.
                            </p>
                            <ul>
                                <li>
                                    <i class="bi bi-check-circle"></i>
                                    <div>
                                        <h4>Cepat & Tepat Waktu</h4>
                                        <p>
                                            Kami menjanjikan pengiriman yang tepat waktu dan bebas
                                            dari keterlambatan. Baik itu pengiriman
                                            <span class="fst-italic">Same Day, Next Day,</span> atau
                                            Reguler – semua berjalan mulus!
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <i class="bi bi-shield-check"></i>
                                    <div>
                                        <h4>Keamanan Terjamin</h4>
                                        <p>
                                            Setiap paket Anda adalah prioritas kami. Dengan fitur
                                            pelacakan real-time dan asuransi, Anda tak perlu
                                            khawatir lagi. Kami mengawal paket Anda hingga sampai
                                            tujuan.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                            <p>
                                Di CepatKirim, kami percaya bahwa setiap paket memiliki
                                cerita. Dengan komitmen penuh, kami membantu Anda mengirimkan
                                kebahagiaan, harapan, dan kebutuhan ke seluruh penjuru negeri.
                                Teknologi canggih dan tim profesional kami siap memastikan
                                setiap pengiriman cepat, aman, dan tanpa ribet.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /About Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div
                        class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                        <i class="bi bi-emoji-smile"></i>
                        <div class="stats-item">
                            <span
                                data-purecounter-start="0"
                                data-purecounter-end="232"
                                data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Happy Clients</p>
                        </div>
                    </div>
                    <!-- End Stats Item -->

                    <div
                        class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                        <i class="bi bi-journal-richtext"></i>
                        <div class="stats-item">
                            <span
                                data-purecounter-start="0"
                                data-purecounter-end="521"
                                data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Projects</p>
                        </div>
                    </div>
                    <!-- End Stats Item -->

                    <div
                        class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                        <i class="bi bi-headset"></i>
                        <div class="stats-item">
                            <span
                                data-purecounter-start="0"
                                data-purecounter-end="1463"
                                data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Hours Of Support</p>
                        </div>
                    </div>
                    <!-- End Stats Item -->

                    <div
                        class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                        <i class="bi bi-people"></i>
                        <div class="stats-item">
                            <span
                                data-purecounter-start="0"
                                data-purecounter-end="15"
                                data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Hard Workers</p>
                        </div>
                    </div>
                    <!-- End Stats Item -->
                </div>
            </div>
        </section>
        <!-- /Stats Section -->

        <!-- Clients Section -->
        <section id="clients" class="clients section light-background">
            <div class="container">
                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            },
                            "breakpoints": {
                                "320": {
                                    "slidesPerView": 2,
                                    "spaceBetween": 40
                                },
                                "480": {
                                    "slidesPerView": 3,
                                    "spaceBetween": 60
                                },
                                "640": {
                                    "slidesPerView": 4,
                                    "spaceBetween": 80
                                },
                                "992": {
                                    "slidesPerView": 6,
                                    "spaceBetween": 120
                                }
                            }
                        }
                    </script>
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide">
                            <img
                                src="user/assets/img/clients/client-1.png"
                                class="img-fluid"
                                alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img
                                src="user/assets/img/clients/client-2.png"
                                class="img-fluid"
                                alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img
                                src="user/assets/img/clients/client-3.png"
                                class="img-fluid"
                                alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img
                                src="user/assets/img/clients/client-4.png"
                                class="img-fluid"
                                alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img
                                src="user/assets/img/clients/client-5.png"
                                class="img-fluid"
                                alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img
                                src="user/assets/img/clients/client-6.png"
                                class="img-fluid"
                                alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img
                                src="user/assets/img/clients/client-7.png"
                                class="img-fluid"
                                alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img
                                src="user/assets/img/clients/client-8.png"
                                class="img-fluid"
                                alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Clients Section -->

        <!-- Services Section -->
        <section id="services" class="services section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan</h2>
                <p>
                    <span>Layanan Terbaik</span>
                    <span class="description-title">Kami</span>
                </p>
            </div>
            <!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">
                    <div
                        class="col-lg-4 col-md-6"
                        data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-truck"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>Pengiriman Reguler</h3>
                            </a>
                            <p>
                                Layanan pengiriman hemat dengan estimasi waktu sampai 2-5
                                hari. Cocok untuk kebutuhan sehari-hari.
                            </p>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div
                        class="col-lg-4 col-md-6"
                        data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-lightning"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>Pengiriman Ekspres</h3>
                            </a>
                            <p>
                                Pengiriman super cepat! Paket sampai di hari yang sama atau
                                H+1. Kecepatan adalah prioritas kami.
                            </p>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div
                        class="col-lg-4 col-md-6"
                        data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>Pengiriman Cargo</h3>
                            </a>
                            <p>
                                Layanan khusus untuk pengiriman barang besar dan berat dengan
                                biaya terjangkau. Ideal untuk bisnis Anda.
                            </p>
                        </div>
                    </div>
                    <!-- End Service Item -->
                </div>
            </div>
        </section>
        <!-- /Services Section -->
    </main>

    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">CepatKirim</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3">
                            <strong>Phone:</strong> <span>+1 5589 55488 55</span>
                        </p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li>
                            <i class="bi bi-chevron-right"></i> <a href="#">About us</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i> <a href="#">Services</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#">Terms of service</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li>
                            <i class="bi bi-chevron-right"></i> <a href="#">Web Design</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#">Web Development</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i>
                            <a href="#">Product Management</a>
                        </li>
                        <li>
                            <i class="bi bi-chevron-right"></i> <a href="#">Marketing</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>
                        Cras fermentum odio eu feugiat lide par naso tierra videa magna
                        derita valies
                    </p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>
                © <span>Copyright</span>
                <strong class="px-1 sitename">CepatKirim</strong>
                <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by
                <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by
                <a href=“https://themewagon.com>ThemeWagon
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a
        href="#"
        id="scroll-top"
        class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <!-- Vendor JS Files -->
    <script src="user/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="user/assets/vendor/php-email-form/validate.js"></script>
    <script src="user/assets/vendor/aos/aos.js"></script>
    <script src="user/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="user/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="user/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="user/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="user/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="user/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="user/assets/js/main.js"></script>
</body>

</html>