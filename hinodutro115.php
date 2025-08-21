<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "u868657420_db_dealer_hino"; // ganti sesuai nama database Anda

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil produk berdasarkan slug (misalnya hino300)
$slug = "hino300"; 
$sql  = "SELECT * FROM products WHERE slug = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $slug);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

// Ambil kategori spesifikasi untuk produk ini
$sql_cat = "SELECT * FROM product_specs_category WHERE product_id = ?";
$stmt_cat = $conn->prepare($sql_cat);
$stmt_cat->bind_param("i", $product['id']);
$stmt_cat->execute();
$categories = $stmt_cat->get_result();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Title -->
    <title>Hino 300 Series | Truk Ringan Tangguh untuk Bisnis Anda</title>

    <!-- Meta Description -->
    <meta
      name="description"
      content="Dealer Resmi Hino Jakarta. Hubungi : 0859 7528 7684 / 0882 1392 5184 Untuk mendapatkan informasi produk Hino. Layanan Terbaik dan Jaminan Mutu."
    />

    <!-- Meta Keywords -->
    <meta
      name="keywords"
      content="sales Hino, sales Hino Jakarta, sales Hino Jabodetabek, sales Hino Tangerang, sales Hino Bekasi, sales Hino Depok, sales Hino Bogor, sales truck Hino, dealer Hino, dealer Hino Jabodetabek, dealer Hino Tangerang, dealer Hino Bekasi, dealer Hino Depok, dealer Hino Bogor, dealer truck Hino, dealer Hino resmi, dealer Hino Jakarta, dealer Hino Indonesia, jual truk Hino, kredit truk Hino, cicilan truk Hino, promo truk Hino, harga truk Hino terbaru, diskon truk Hino, truk Hino Dutro, truk Hino 300, truk Hino 500, Hino Dutro 136 HD, Hino Dutro 4x4, Hino Dutro box, Hino Dutro engkel, spesifikasi Hino Dutro, modifikasi truk Hino, gambar truk Hino, keunggulan truk Hino, truk Hino untuk bisnis, truk Hino untuk logistik, perbandingan truk Hino dan Isuzu Elf, dealer truk Hino termurah"
    />

    <!-- Canonical URL -->
    <link rel="canonical" href="https://saleshinoindonesia.com/hino300.php" />

    <!-- Open Graph -->
    <meta property="og:title" content="Dealer Hino Indonesia | Promo & Harga Truk Terbaik" />
    <meta property="og:description" content="Dapatkan promo truk Hino terbaru di Jakarta. Konsultasi langsung dengan sales profesional. Gratis penawaran & layanan cepat!" />
    <meta property="og:image" content="https://saleshinoindonesia.com/img/promohino1.jpg" />
    <meta property="og:url" content="https://saleshinoindonesia.com/hino300.php" />
    <meta property="og:type" content="website" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Dealer Hino Indonesia | Promo & Harga Truk Terbaik" />
    <meta name="twitter:description" content="Hubungi kami untuk mendapatkan penawaran terbaik truk Hino. Layanan cepat & profesional." />
    <meta name="twitter:image" content="https://saleshinoindonesia.com/img/promohino1.jpg" />

    <meta name="robots" content="index, follow" />

    <link rel="icon" type="image/png" href="/img/favicon.png" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet" />

    <link rel="icon" type="image/png" href="img/logo.png" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/sparepart_css/header_sparepart.css" />
    <link rel="stylesheet" href="css/sparepart_css/product_sparepart.css" />

    <style>
      html, body { height: 100%; margin: 0; padding: 0; }
      body { display: flex; flex-direction: column; min-height: 100vh; }
      main { flex: 1; }
      .product-container { max-width: 1000px; margin: auto; padding: 20px; }
      .product-container img { max-width: 100%; border-radius: 10px; }
      .spec-category { margin-top: 30px; }
      .spec-category h3 { background: #f4f4f4; padding: 10px; border-left: 4px solid green; }
      .spec-table { width: 100%; border-collapse: collapse; }
      .spec-table th, .spec-table td { border: 1px solid #ddd; padding: 8px; }
      .spec-table th { background: #f9f9f9; text-align: left; }
    </style>

    <script src="js/script.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body>
    <!-- Header -->
    <header>
      <div class="container header-content navbar">
        <div class="header-title">
          <a href="https://saleshinoindonesia.com">
            <img src="img/logo3.png" alt="Logo Hino" style="height: 60px" />
          </a>
        </div>
        <div class="hamburger-menu">&#9776;</div>
        <nav class="nav links">
          <a href="index.php">Home</a>
          <a href="hino300.php">Hino 300 Series</a>
          <a href="hino500.php">Hino 500 Series</a>
          <a href="hinobus.php">Hino Bus Series</a>
          <a href="artikel.php">Blog & Artikel</a>
          <a href="contact.html">Contact</a>
        </nav>
      </div>
    </header>

    <!-- Mulai konten utama -->
    <main>
      <!-- Hero -->
      <section class="about-hero" style="background-image: url('<?php echo $product['image']; ?>'); background-size: cover; background-position: center; height: 300px;"></section>

      <!-- Produk -->
      <div class="products">
        <h1><?php echo $product['name']; ?></h1>
        <p><?php echo nl2br($product['description']); ?></p>

        <!-- Spesifikasi -->
        <?php while ($cat = $categories->fetch_assoc()): ?>
          <div class="products_specs_category">
            <h3><?php echo $cat['category_name']; ?></h3>
            <table class="spec-table">
              <tbody>
                <?php
                $sql_detail = "SELECT * FROM product_specs_detail WHERE category_id = ?";
                $stmt_detail = $conn->prepare($sql_detail);
                $stmt_detail->bind_param("i", $cat['id']);
                $stmt_detail->execute();
                $details = $stmt_detail->get_result();
                while ($row = $details->fetch_assoc()):
                ?>
                  <tr>
                    <th><?php echo $row['spec_label']; ?></th>
                    <td><?php echo $row['spec_value']; ?></td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        <?php endwhile; ?>
      </div>

      <!-- CTA -->
      <div class="cta-full">
        <h2>Tidak menemukan apa yang kamu cari?</h2>
        <a href="https://wa.me/+6285975287684?text=Halo%20Saya%20Ingin%20Menanyakan%20Tentang%20Produk" class="cta-full-button">Hubungi Kami</a>
      </div>
    </main>
    <!-- Akhir konten utama -->

    <!-- Footer (tidak berubah) -->
    <footer class="site-footer">
      <div class="footer-container">
        <div class="footer-section">
          <img src="img/logo3.png" alt="Logo" class="footer-logo" />
          <p>Nathan, Sales Hino Indonesia yang berpengalaman dan profesional, siap menjadi mitra terbaik Anda dalam memenuhi kebutuhan kendaraan niaga.</p>
        </div>
        <div class="footer-section">
          <h4>HUBUNGI KAMI</h4>
          <p>📞 0859-7528-7684</p>
          <p>📧 saleshinojabodetabek@gmail.com</p>
          <p>📍 Golf Lake Ruko Venice, Jl. Lkr. Luar Barat No.78 Blok B, Jakarta</p>
          <div class="footer-social" style="margin-top: 20px">
            <h4>SOSIAL MEDIA</h4>
            <div class="social-icons">
              <a href="https://www.instagram.com/saleshinojabodetabek" target="_blank"><i data-feather="instagram"></i></a>
              <a href="https://wa.me/+6285975287684" target="_blank"><i data-feather="phone"></i></a>
              <a href="https://www.facebook.com/profile.php?id=61573843992250" target="_blank"><i data-feather="facebook"></i></a>
            </div>
          </div>
        </div>
        <div class="footer-section">
          <div class="google-map-container" style="margin-top: 20px">
            <iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2025 Sales Hino Indonesia. All Rights Reserved.</p>
      </div>
    </footer>

    <script src="https://static.elfsight.com/platform/platform.js" async></script>
    <div class="elfsight-app-1c150e27-6597-4113-becd-79df393b9756" data-elfsight-app-lazy></div>
    <script> feather.replace(); </script>
  </body>
</html>
