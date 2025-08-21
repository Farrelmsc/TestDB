<?php
require_once __DIR__ . '/admin/config.php'; // sesuaikan path jika perlu

// Info koneksi & server
$q = $conn->query("SELECT DATABASE() AS db, USER() AS user, @@hostname AS host, VERSION() AS ver");
$info = $q ? $q->fetch_assoc() : null;

echo "<h3>Informasi koneksi</h3><pre>";
print_r($info);
echo "</pre>";

// Cek tabel (tampilkan 10 tabel pertama)
echo "<h3>Daftar tabel (sample)</h3><ul>";
$res = $conn->query("SHOW TABLES");
while ($t = $res->fetch_array()) {
    echo "<li>" . htmlspecialchars($t[0]) . "</li>";
}
echo "</ul>";

// Cek isi tabel contoh (jika ada 'admin')
if ($conn->query("SHOW TABLES LIKE 'admin'")->num_rows) {
    echo "<h3>Isi tabel admin (5 baris)</h3><pre>";
    $r = $conn->query("SELECT * FROM admin LIMIT 5");
    while ($row = $r->fetch_assoc()) print_r($row);
    echo "</pre>";
} else {
    echo "<p>Tabel <b>admin</b> tidak ditemukan.</p>";
}
