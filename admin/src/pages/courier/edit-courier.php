<?php
session_start();

// Pastikan pengguna sudah login dan memiliki role_id
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    echo '<script>
    alert("Anda Harus Login Terlebih Dahulu");
    window.location.href = "../../../../login.php";
</script>';
    exit();
}

include '../../../../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the current courier data from the database
    $query = "SELECT * FROM couriers WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $courier = $result->fetch_assoc();

    if (!$courier) {
        echo "Courier not found!";
        exit;
    }

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        // Update the courier data
        $updateQuery = "UPDATE couriers SET name = ?, phone = ?, email = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("sssi", $name, $phone, $email, $id);

        if ($updateStmt->execute()) {
            header('Location: courier.php'); // Redirect to the courier listing page
            exit;
        } else {
            echo "Error updating courier data!";
        }
    }
} else {
    echo "No courier ID provided!";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Ekspedisi</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div
                    class="brand-logo d-flex align-items-center justify-content-between">
                    <h2 class="fw-bolder">Cepat<span class="text-primary">Admin</span></h2>
                    <div
                        class="close-btn d-xl-none d-block sidebartoggler cursor-pointer"
                        id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a
                                class="sidebar-link"
                                href="./index.html"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Information</span>
                        </li>
                        <li class="sidebar-item">
                            <a
                                class="sidebar-link"
                                href="../packages/packages.php"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Packages</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a
                                class="sidebar-link"
                                href="../courier/courier.php"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-alert-circle"></i>
                                </span>
                                <span class="hide-menu">Couriers</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a
                                class="sidebar-link"
                                href="../packages-status/status.php"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-cards"></i>
                                </span>
                                <span class="hide-menu">Packages Status</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a
                                class="sidebar-link"
                                href="../customer/customer.php"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-description"></i>
                                </span>
                                <span class="hide-menu">Customer</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">AUTH</span>
                        </li>
                        <li class="sidebar-item">
                            <a
                                class="sidebar-link"
                                href="../../../../logout.php"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-login"></i>
                                </span>
                                <span class="hide-menu">Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->

        <div class="body-wrapper">
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a
                                class="nav-link sidebartoggler nav-icon-hover"
                                id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div
                        class="navbar-collapse justify-content-end px-0"
                        id="navbarNav">
                        <ul
                            class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link nav-icon-hover"
                                    href="javascript:void(0)"
                                    id="drop2"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img
                                        src="../../assets/images/profile/user-1.jpg"
                                        alt=""
                                        width="35"
                                        height="35"
                                        class="rounded-circle" />
                                </a>
                                <div
                                    class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a
                                            href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a
                                            href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a
                                            href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a
                                            href="./authentication-login.html"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Edit Courier</h5>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($courier['name']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="number" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($courier['phone']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($courier['email']); ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="courier.php" class="btn btn-secondary">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/sidebarmenu.js"></script>
    <script src="../../assets/js/app.min.js"></script>
    <script src="../../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../../assets/js/dashboard.js"></script>
</body>

</html>