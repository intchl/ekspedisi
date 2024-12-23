<?php
session_start();

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
  echo '<script>
      alert("Anda Harus Login Terlebih Dahulu");
      window.location.href = "../login.php";
  </script>';
  exit();
}

include '../koneksi.php';

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

// Query hanya mengambil data berdasarkan user_id
$sql = "SELECT p.id, p.resi, u.name AS user_name, c.name AS courier_name, p.description, 
               p.pickup_address, p.delivery_address, ps.status_name, p.shipper, p.recipient, 
               p.created_at, p.updated_at
        FROM packages AS p
        INNER JOIN users AS u ON p.user_id = u.id
        INNER JOIN couriers AS c ON p.courier_id = c.id
        INNER JOIN package_statuses AS ps ON p.current_status_id = ps.id
        WHERE p.user_id = ? ORDER BY 
    p.created_at DESC";

// Gunakan prepared statement untuk keamanan
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();


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
  <link href="assets/img/favicon.png" rel="icon" />
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link
    href="assets/vendor/bootstrap/css/bootstrap.min.css"
    rel="stylesheet" />
  <link
    href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
    rel="stylesheet" />
  <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
  <link
    href="assets/vendor/glightbox/css/glightbox.min.css"
    rel="stylesheet" />
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet" />

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
        <a href="index.php" class="logo d-flex align-items-center">
          <h1 class="sitename">
            Cepat<span class="text-primary">Kirim</span>
          </h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="../logout.php"><button class="btn btn-primary rounded-pill">Logout</button></a></li>

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
        <div class="col d-flex justify-content-between">
          <h5 class="card-title fw-semibold mb-4">Data Paket</h5>
          <a href="add-packages.php" class="btn btn-primary m-1">
            <i class="bi bi-plus"></i>
          </a>
        </div>
      </div>
    </div><!-- End Page Title -->

    <section id="service-details" class="service-details section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Resi Number</th>
                    <th>Shipper</th>
                    <th>Recipient</th>
                    <th>Courier Name</th>
                    <th>Description</th>
                    <th>Pickup Address</th>
                    <th>Delivery Address</th>
                    <th>Current Status</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Update At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  if ($result->num_rows > 0):
                    while ($row = $result->fetch_assoc()): ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['resi']); ?></td>
                        <td><?php echo htmlspecialchars($row['shipper']); ?></td>
                        <td><?php echo htmlspecialchars($row['recipient']); ?></td>
                        <td><?php echo htmlspecialchars($row['courier_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['pickup_address']); ?></td>
                        <td><?php echo htmlspecialchars($row['delivery_address']); ?></td>
                        <td><?php echo htmlspecialchars($row['status_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td><?php echo htmlspecialchars($row['updated_at']); ?></td>
                        <td>
                          <a href="edit-packages.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil" style="color: white;"></i>
                          </a>
                        </td>
                      </tr>
                    <?php endwhile;
                  else: ?>
                    <tr>
                      <td colspan="13">No packages found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>


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
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
</body>


</html>