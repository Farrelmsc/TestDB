<?php
$host = "localhost";   // host server
$user = "root";        // username MySQL
$pass = "";            // password MySQL (kosongkan kalau default XAMPP)
$db   = "u868657420_db_dealer_hino"; // nama database yang dibuat di phpMyAdmin

// Koneksi ke MySQL
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    echo "Koneksi berhasil!";
}
?>


