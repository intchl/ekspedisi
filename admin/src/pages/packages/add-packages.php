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

// Check if user_id is set in session
if (!isset($_SESSION['user_id'])) {
    die("User ID is not set in the session. Please log in.");
}

include '../../../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate the next ID and Resi automatically
    $result = $conn->query("SELECT resi FROM packages ORDER BY resi DESC LIMIT 1");
    if ($result && $result->num_rows > 0) {
        $last_resi = $result->fetch_assoc()['resi'];
        // Extract the numeric part from the last resi
        $last_number = intval(substr($last_resi, 6));
        $new_number = str_pad($last_number + 1, 3, "0", STR_PAD_LEFT); // Increment and format to 3 digits
    } else {
        $new_number = "001"; // First resi if none exists
    }
    $resi = "CPTKRM" . $new_number; // New resi

    // Get the rest of the input values
    $courier_id = $_POST['courier_id'];
    $description = $_POST['description'];
    $pickup_address = $_POST['pickup_address'];
    $delivery_address = $_POST['delivery_address'];
    $current_status_id = $_POST['current_status_id'];
    $shipper = $_POST['shipper'];
    $recipient = $_POST['recipient'];
    $user_id = $_SESSION['user_id'];

    // Prepare and execute the query to prevent SQL injection
    $stmt = $conn->prepare(
        "INSERT INTO packages (id, resi, user_id, courier_id, description, pickup_address, delivery_address, current_status_id, shipper, recipient) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("ssissssiss", $id, $resi, $user_id, $courier_id, $description, $pickup_address, $delivery_address, $current_status_id, $shipper, $recipient);

    if ($stmt->execute()) {
        header("Location: packages.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch data for dropdowns
$couriers = $conn->query("SELECT id, name FROM couriers");
$statuses = $conn->query("SELECT id, status_name FROM package_statuses");
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
                        <h5 class="card-title fw-semibold mb-4">Add Packages</h5>
                        <div class="card">
                            <div class="card-body">
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="shipper" class="form-label">Shipper</label>
                                        <input type="text" class="form-control" id="shipper" name="shipper" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient" class="form-label">Recipient</label>
                                        <input type="text" class="form-control" id="recipient" name="recipient" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="courier_id" class="form-label">Courier</label>
                                        <select class="form-control" id="courier_id" name="courier_id" required>
                                            <option value="">Select Courier</option>
                                            <?php while ($row = $couriers->fetch_assoc()) { ?>
                                                <option value="<?= $row['id'] ?>">
                                                    <?= $row['name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pickup_address" class="form-label">Pickup Address</label>
                                        <input type="text" class="form-control" id="pickup_address" name="pickup_address" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="delivery_address" class="form-label">Delivery Address</label>
                                        <input type="text" class="form-control" id="delivery_address" name="delivery_address" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="current_status_id" class="form-label">Current Status</label>
                                        <select class="form-control" id="current_status_id" name="current_status_id" required>
                                            <option value="">Select Status</option>
                                            <?php while ($row = $statuses->fetch_assoc()) { ?>
                                                <option value="<?= $row['id'] ?>">
                                                    <?= $row['status_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Package</button>
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