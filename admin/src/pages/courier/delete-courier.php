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

    // Delete the courier data
    $deleteQuery = "DELETE FROM couriers WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: courier.php');
        exit;
    } else {
        echo "Error deleting courier!";
    }
} else {
    echo "No courier ID provided!";
    exit;
}
