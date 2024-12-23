<?php
include 'koneksi.php'; // Pastikan koneksi ke database sudah benar

$error_message = "";
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];


  // Cek apakah email sudah terdaftar
  $sql_check = "SELECT * FROM users WHERE email = ?";
  $stmt_check = $conn->prepare($sql_check);
  $stmt_check->bind_param("s", $email);
  $stmt_check->execute();
  $result_check = $stmt_check->get_result();

  if ($result_check->num_rows > 0) {
    $error_message = "Email sudah digunakan. Silakan gunakan email lain.";
  } else {
    // Insert data ke tabel users dengan role_id = 2
    $sql = "INSERT INTO users (name, email, password, phone, role_id) VALUES (?, ?, ?, ?, 2)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $password, $phone);

    if ($stmt->execute()) {
      $success_message = "Pendaftaran berhasil! Silakan login.";
    } else {
      $error_message = "Terjadi kesalahan. Silakan coba lagi.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register - CepatKirim</title>
  <link rel="shortcut icon" type="image/png" href="admin/src/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="admin/src/assets/css/styles.min.css" />
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <h1 class="sitename fw-bolder text-center">
                  Cepat<span class="text-primary">Kirim</span>
                </h1>
                <p class="text-center">Layanan Kirim Paket Terpercaya</p>

                <!-- Tampilkan alert jika ada pesan error atau sukses -->
                <?php if (!empty($error_message)) : ?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                  </div>
                <?php endif; ?>

                <?php if (!empty($success_message)) : ?>
                  <div class="alert alert-success" role="alert">
                    <?php echo $success_message; ?>
                  </div>
                <?php endif; ?>

                <form action="" method="POST">
                  <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" required />
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required />
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required />
                  </div>
                  <div class="mb-4">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" required />
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                    Daftar
                  </button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Sudah punya akun?</p>
                    <a class="text-primary fw-bold ms-2" href="login.php">Masuk</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="admin/src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="admin/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>