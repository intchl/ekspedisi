<?php
session_start();
include 'koneksi.php';

$error_message = "";
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['user_email'] = $row['email'];
    $_SESSION['role_id'] = $row['role_id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['user_id'] = $row['id'];

    $success_message = "Berhasil login!";

    // Redirect based on role_id after displaying alert
    echo "<script>
      alert('$success_message');
      window.location.href = '" . ($row['role_id'] == '1' ? "admin/src/pages/packages/packages.php" : "user/index.php") . "';
    </script>";
    exit();
  } else {
    $error_message = "ID atau Password Salah!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - CepatKirim</title>
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

                <!-- Show alert if there is an error message -->
                <?php if (!empty($error_message)) : ?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                  </div>
                <?php endif; ?>

                <form action="" method="POST">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required />
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required />
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                    Masuk
                  </button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Belum punya akun?</p>
                    <a class="text-primary fw-bold ms-2" href="register.php">Buat Akun</a>
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