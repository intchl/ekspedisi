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

if (!isset($_GET['id']) || empty($_GET['id'])) {
  die("Invalid Request");
}

$original_id = intval($_GET['id']);

// Fetch package details by ID
$sql = "SELECT * FROM packages WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $original_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  die("Package not found");
}

$package = $result->fetch_assoc();

// Fetch data for dropdowns
$couriers = $conn->query("SELECT id, name FROM couriers");
$statuses = $conn->query("SELECT id, status_name FROM package_statuses");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $resi = $_POST['resi'] ?? null;
  $courier_id = intval($_POST['courier_id'] ?? 0);
  $description = $_POST['description'] ?? '';
  $pickup_address = $_POST['pickup_address'] ?? '';
  $delivery_address = $_POST['delivery_address'] ?? '';
  $current_status_id = intval($_POST['current_status_id'] ?? 0);
  $shipper = $_POST['shipper'] ?? '';
  $recipient = $_POST['recipient'] ?? '';

  // Start transaction to safely handle ID changes
  $conn->begin_transaction();

  try {
    // Update query
    $update_sql = "UPDATE packages SET 
              description = ?, 
              pickup_address = ?, 
              delivery_address = ?, 
              shipper = ?,
              recipient = ?
              WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param(
      "sssssi",
      $description,
      $pickup_address,
      $delivery_address,
      $shipper,
      $recipient,
      $original_id
    );

    if (!$update_stmt->execute()) {
      throw new Exception("Error: " . $conn->error);
    }

    // Commit transaction
    $conn->commit();
    header("Location: index.php?success=1");
    exit();
  } catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo $e->getMessage();
  }
}
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
          <h5 class="card-title fw-semibold mb-4">Edit Data</h5>
        </div>
      </div>
    </div><!-- End Page Title -->

    <section id="starter-section" class="starter-section section">
      <div class="container">
        <form method="POST">
          <div class="mb-3">
            <label for="resi" class="form-label">Resi Number</label>
            <h5 class="fw-bolder"><?php echo htmlspecialchars($package['resi']); ?> </h5>
          </div>
          <div class="mb-3">
            <label for="shipper" class="form-label">Shipper</label>
            <input type="text" id="shipper" name="shipper" class="form-control" value="<?php echo htmlspecialchars($package['shipper']); ?>" required />
          </div>
          <div class="mb-3">
            <label for="recipient" class="form-label">Recipient</label>
            <input type="text" id="recipient" name="recipient" class="form-control" value="<?php echo htmlspecialchars($package['recipient']); ?>" required />
          </div>
          <div class="mb-3">
            <label for="courier_name" class="form-label">Courier Name</label>
            <p class="fw-bold">
              <?php
              while ($courier = $couriers->fetch_assoc()) {
                if ($courier['id'] == $package['courier_id']) {
                  echo htmlspecialchars($courier['name']);
                  break;
                }
              }
              ?>
            </p>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($package['description']); ?></textarea>
          </div>
          <div class="mb-3">
            <label for="pickup_address" class="form-label">Pickup Address</label>
            <input type="text" id="pickup_address" name="pickup_address" class="form-control" value="<?php echo htmlspecialchars($package['pickup_address']); ?>" required />
          </div>
          <div class="mb-3">
            <label for="delivery_address" class="form-label">Delivery Address</label>
            <input type="text" id="delivery_address" name="delivery_address" class="form-control" value="<?php echo htmlspecialchars($package['delivery_address']); ?>" required />
          </div>
          <div class="mb-3">
            <label for="current_status_id" class="form-label">Current Status</label>
            <p class="fw-bold">
              <?php
              while ($status = $statuses->fetch_assoc()) {
                if ($status['id'] == $package['current_status_id']) {
                  echo htmlspecialchars($status['status_name']);
                  break;
                }
              }
              ?>
            </p>
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
      </div>

    </section><!-- End Starter Section -->


  </main>
  >

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