<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "ekspedisi";

$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
