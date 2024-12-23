<?php
include 'koneksi.php';

$message = '';
$package = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $conn->real_escape_string($_POST['resi']); // Mencegah SQL injection

    // Query untuk mencari data berdasarkan nomor resi
    $sql = "SELECT 
    p.id AS package_id,
    p.resi AS resi_id,
    u.name AS user_name,
    c.name AS courier_name,
    p.description,
    p.pickup_address,
    p.delivery_address,
    p.shipper,
    p.recipient,
    ps.status_name AS status_name,
    p.created_at,
    p.updated_at
FROM 
    packages p
LEFT JOIN 
    users u ON p.user_id = u.id
LEFT JOIN 
    couriers c ON p.courier_id = c.id
LEFT JOIN 
    package_statuses ps ON p.current_status_id = ps.id
WHERE 
    p.resi = ?;";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $id); // Bind nomor resi
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $package = $result->fetch_assoc(); // Ambil data
        } else {
            $message = "Nomor resi tidak ditemukan.";
        }

        $stmt->close();
    } else {
        $message = "Terjadi kesalahan pada query.";
    }
}

$conn->close();
?>


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
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="user/assets/img/logo.png" alt=""> -->
                    <h1 class="sitename">
                        Cepat<span class="text-primary">Kirim</span>
                    </h1>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php#about">About</a></li>
                        <li><a href="index.php#services">Services</a></li>
                        <li><a href="login.php"><button class="btn btn-primary rounded-pill px-3">Login</button></a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
            </div>
        </div>
    </header>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <?php if ($package): ?>
                    <h1 class="mb-2 mb-lg-0"><?= htmlspecialchars($package['resi_id']); ?></h1>
            </div>
        </div><!-- End Page Title -->

        <!-- Starter Section Section -->
        <section id="starter-section" class="starter-section section">


            <div class="container" data-aos="fade-up">
                <p><strong>Nama Penerima:</strong> <?= htmlspecialchars($package['shipper']); ?></p>
                <p><strong>Nama Pengirim:</strong> <?= htmlspecialchars($package['recipient']); ?></p>
                <p><strong>Kurir:</strong> <?= htmlspecialchars($package['courier_name']); ?></p>
                <p><strong>Deskripsi:</strong> <?= htmlspecialchars($package['description']); ?></p>
                <p><strong>Alamat Pengambilan:</strong> <?= htmlspecialchars($package['pickup_address']); ?></p>
                <p><strong>Alamat Pengiriman:</strong> <?= htmlspecialchars($package['delivery_address']); ?></p>
                <p><strong>Status Saat Ini:</strong> <?= htmlspecialchars($package['status_name']); ?></p>
                <p><strong>Dibuat Pada:</strong> <?= htmlspecialchars($package['created_at']); ?></p>
                <p><strong>Diperbarui Pada:</strong> <?= htmlspecialchars($package['updated_at']); ?></p>
            <?php elseif ($message): ?>
                <p><?= htmlspecialchars($message); ?></p>
            <?php endif; ?>
            </div>

        </section><!-- /Starter Section Section -->

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