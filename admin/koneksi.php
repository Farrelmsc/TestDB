<?php
// File: koneksi.php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "u868657420_db_dealer_hino";

// Buat koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");

// Return koneksi
return $conn;
?>