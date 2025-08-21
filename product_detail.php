<?php
// File: product_detail.php
session_start();

// Koneksi ke database
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

// Fungsi untuk mendapatkan produk berdasarkan ID
function getProductById($connection, $id) {
    $stmt = $connection->prepare("SELECT * FROM products WHERE id = ? AND status = 'active'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

// Ambil data produk jika ada parameter ID
$product = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product = getProductById($conn, $_GET['id']);
}

// Jika produk tidak ditemukan, redirect ke halaman 404 atau daftar produk
if (!$product) {
    header("Location: hino300.html");
    exit();
}

// Decode gallery images
$gallery_images = [];
if (!empty($product['gallery_images'])) {
    $gallery_images = json_decode($product['gallery_images'], true);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Title -->
    <title><?php echo $product['name']; ?> | Sales Hino Indonesia</title>

    <!-- Meta Description -->
    <meta
      name="description"
      content="<?php echo $product['short_description']; ?>"
    />

    <!-- Canonical URL -->
    <link rel="canonical" href="https://saleshinoindonesia.com/product_detail.php?id=<?php echo $product['id']; ?>" />

    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta
      property="og:title"
      content="<?php echo $product['name']; ?> | Sales Hino Indonesia"
    />
    <meta
      property="og:description"
      content="<?php echo $product['short_description']; ?>"
    />
    <meta
      property="og:image"
      content="<?php echo $product['main_image']; ?>"
    />
    <meta
      property="og:url"
      content="https://saleshinoindonesia.com/product_detail.php?id=<?php echo $product['id']; ?>"
    />
    <meta property="og:type" content="website" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta
      name="twitter:title"
      content="<?php echo $product['name']; ?> | Sales Hino Indonesia"
    />
    <meta
      name="twitter:description"
      content="<?php echo $product['short_description']; ?>"
    />
    <meta
      name="twitter:image"
      content="<?php echo $product['main_image']; ?>"
    />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/img/favicon.png" />

    <!-- Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" type="image/png" href="img/logo.png" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/sparepart_css/header_sparepart.css" />
    <link rel="stylesheet" href="css/sparepart_css/product_sparepart.css" />
    <link rel="stylesheet" href="css/detail.css" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    
    <style>
      :root {
        --hino-blue: #0051a2;
        --hino-light-blue: #e6f0fa;
        --hino-dark: #333;
        --hino-gray: #f5f5f5;
      }
      
      /* Layout */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
      }

      main {
        flex: 1;
      }
      
      /* Product Detail Styles - REVISED FOR VERTICAL LAYOUT */
      .product-detail-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 30px 20px;
      }
      
      .product-title {
        font-size: 2.2rem;
        color: var(--hino-blue);
        margin-bottom: 10px;
        font-weight: 700;
        text-align: center;
      }
      
      .product-subtitle {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 30px;
        text-align: center;
      }
      
      .image-section {
        margin-bottom: 30px;
      }
      
      .main-image-container {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
      }
      
      .main-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
      }
      
      .gallery-thumbnails {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
        justify-content: center;
      }
      
      .gallery-thumbnail {
        width: 80px;
        height: 60px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 4px;
        transition: all 0.3s ease;
      }
      
      .gallery-thumbnail:hover, .gallery-thumbnail.active {
        border-color: var(--hino-blue);
        transform: scale(1.05);
      }
      
      .product-short-description {
        background-color: var(--hino-light-blue);
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-size: 1.1rem;
        line-height: 1.6;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
      }
      
      /* Accordion Styles - REVISED */
      .accordion-container {
        margin-top: 30px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
      }
      
      .accordion-item {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      }
      
      .accordion-header {
        background-color: rgba(255, 255, 255, 0.9); /* Putih transparan */
        padding: 15px 20px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.3s;
      }
      
      .accordion-header:hover {
        background-color: rgba(255, 255, 255, 1); /* Putih solid saat hover */
      }
      
      .accordion-header h3 {
        margin: 0;
        font-size: 1.2rem;
        color: #000; /* Hitam */
        font-weight: 700; /* Tebal */
      }
      
      .accordion-icon {
        transition: transform 0.3s;
        color: #000; /* Hitam */
      }
      
      .accordion-header.active .accordion-icon {
        transform: rotate(180deg);
      }
      
      .accordion-content {
        padding: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease, padding 0.3s ease;
        background-color: #fff;
      }
      
      .accordion-content.active {
        max-height: 1000px;
        padding: 20px;
      }
      
      .specs-table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
      }
      
      .specs-table th, .specs-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
      }
      
      .specs-table th {
        background-color: var(--hino-light-blue);
        width: 40%;
        font-weight: 600;
      }
      
      @media (max-width: 768px) {
        .product-title {
          font-size: 1.8rem;
        }
        
        .main-image {
          height: 300px;
        }
        
        .gallery-thumbnail {
          width: 70px;
          height: 50px;
        }
      }
    </style>
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
          <a href="hino300.html">Hino 300 Series</a>
          <a href="hino500.html">Hino 500 Series</a>
          <a href="hinobus.html">Hino Bus Series</a>
          <a href="artikel.php">Blog & Artikel</a>
          <a href="contact.html">Contact</a>
        </nav>
      </div>
    </header>

    <!-- Mulai konten utama -->
    <main>
      <!-- Sparepart Header Section -->
      <section
        class="about-hero"
        style="
          background-image: url('img/Euro 4 Hino 300.jpeg');
          background-size: cover;
          background-position: center;
        "
      ></section>

      <!-- Product Detail Content - REVISED LAYOUT -->
      <div class="product-detail-container">
        <h1 class="product-title"><?php echo $product['name']; ?></h1>
        <p class="product-subtitle">Model: <?php echo $product['model']; ?> | Seri: <?php echo $product['series']; ?></p>
        
        <!-- Image Section -->
        <div class="image-section">
          <div class="main-image-container">
            <img id="mainImage" src="<?php echo $product['main_image']; ?>" alt="<?php echo $product['name']; ?>" class="main-image">
          </div>
          
          <?php if (!empty($gallery_images) && count($gallery_images) > 0): ?>
          <div class="gallery-thumbnails">
            <?php foreach ($gallery_images as $index => $image): ?>
            <img src="<?php echo $image; ?>" alt="Gallery Image <?php echo $index + 1; ?>" class="gallery-thumbnail <?php echo $index === 0 ? 'active' : ''; ?>" onclick="changeImage(this, '<?php echo $image; ?>')">
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
        
        <!-- Short Description -->
        <div class="product-short-description">
          <p><?php echo nl2br($product['short_description']); ?></p>
        </div>
        
        <!-- Accordion Section -->
        <div class="accordion-container">
          <div class="accordion-item">
            <div class="accordion-header" onclick="toggleAccordion(this)">
              <h3>Spesifikasi Teknis</h3>
              <span class="accordion-icon"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="accordion-content">
              <table class="specs-table">
                <tr>
                  <th>Model</th>
                  <td><?php echo $product['model']; ?></td>
                </tr>
                <tr>
                  <th>Seri</th>
                  <td><?php echo $product['series']; ?></td>
                </tr>
                <tr>
                  <th>Tipe Mesin</th>
                  <td><?php echo $product['engine_type']; ?></td>
                </tr>
                <tr>
                  <th>Displacement</th>
                  <td><?php echo $product['displacement']; ?></td>
                </tr>
                <tr>
                  <th>Daya Maksimum (PS/rpm)</th>
                  <td><?php echo $product['power']; ?></td>
                </tr>
                <tr>
                  <th>Torsi Maksimum (kgm/rpm)</th>
                  <td><?php echo $product['torque']; ?></td>
                </tr>
                <tr>
                  <th>Transmisi</th>
                  <td><?php echo $product['transmission']; ?></td>
                </tr>
                <tr>
                  <th>Ban</th>
                  <td><?php echo $product['tire']; ?></td>
                </tr>
                <tr>
                  <th>Jarak Sumbu Roda</th>
                  <td><?php echo $product['wheelbase']; ?></td>
                </tr>
                <tr>
                  <th>Kapasitas Tangki Bahan Bakar</th>
                  <td><?php echo $product['fuel_capacity']; ?></td>
                </tr>
              </table>
              
              <?php if (!empty($product['specification_content'])): ?>
              <div class="mt-4">
                <h4>Informasi Tambahan</h4>
                <?php echo $product['specification_content']; ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
          
          <div class="accordion-item">
            <div class="accordion-header" onclick="toggleAccordion(this)">
              <h3>Deskripsi Produk</h3>
              <span class="accordion-icon"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="accordion-content">
              <?php echo !empty($product['overview_content']) ? $product['overview_content'] : '<p>Produk berkualitas tinggi dari Hino dengan performa terbaik di kelasnya. Dirancang untuk memberikan pengalaman berkendara yang nyaman dan efisien.</p>'; ?>
            </div>
          </div>
          
          <div class="accordion-item">
            <div class="accordion-header" onclick="toggleAccordion(this)">
              <h3>Aplikasi & Penggunaan</h3>
              <span class="accordion-icon"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div class="accordion-content">
              <?php echo !empty($product['application_content']) ? $product['application_content'] : '<p>Produk ini cocok untuk berbagai aplikasi dan kebutuhan bisnis. Dengan desain yang ergonomis dan fitur yang lengkap, kendaraan ini dapat diandalkan untuk mendukung operasional bisnis Anda.</p>'; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- CTA Section -->
      <div class="cta-full">
        <h2>Tidak menemukan apa yang kamu cari?</h2>
        <a
          href="https://wa.me/+6285975287684?text=Halo%20Saya%20Ingin%20Menanyakan%20Tentang%20Produk"
          class="cta-full-button"
          >Hubungi Kami</a
        >
      </div>
    </main>

    <!-- Footer -->
    <footer class="site-footer">
      <div class="footer-container">
        <div class="footer-section">
          <img src="img/logo3.png" alt="Logo" class="footer-logo" />
          <p>
            Nathan, Sales Hino Indonesia yang berpengalaman dan profesional,
            siap menjadi mitra terbaik Anda dalam memenuhi kebutuhan kendaraan
            niaga.
          </p>
        </div>

        <div class="footer-section">
          <h4>HUBUNGI KAMI</h4>
          <p>📞 0859-7528-7684</p>
          <p>📧 saleshinojabodetabek@gmail.com</p>
          <p>
            📍 Golf Lake Ruko Venice, Jl. Lkr. Luar Barat No.78 Blok B,
            RT.9/RW.14, Cengkareng Tim., Kecamatan Cengkareng, Jakarta
          </p>

          <div class="footer-social" style="margin-top: 20px">
            <h4>SOSIAL MEDIA</h4>
            <div class="social-icons">
              <a
                href="https://www.instagram.com/saleshinojabodetabek"
                target="_blank"
              >
                <i data-feather="instagram"></i>
              </a>
              <a
                href="https://wa.me/+6285975287684?text=Halo%20Saya%20Dapat%20Nomor%20Anda%20Dari%20Google"
                target="_blank"
              >
                <i data-feather="phone"></i>
              </a>
              <a
                href="https://www.facebook.com/profile.php?id=61573843992250"
                target="_blank"
              >
                <i data-feather="facebook"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="footer-section">
          <div class="google-map-container" style="margin-top: 20px">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.001117199873!2d106.72798237355298!3d-6.130550360104524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f70ab03b3611%3A0x2e6e345ac4d4fd04!2sHINO%20CENGKARENG%20(DGMI)!5e0!3m2!1sid!2sid!4v1752934707067!5m2!1sid!2sid"
              width="600"
              height="450"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2025 Sales Hino Indonesia. All Rights Reserved.</p>
      </div>
    </footer>

    <!-- Bootstrap & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
      // Fungsi untuk mengganti gambar utama
      function changeImage(element, imageUrl) {
        document.getElementById('mainImage').src = imageUrl;
        
        // Hapus kelas active dari semua thumbnail
        var thumbnails = document.getElementsByClassName('gallery-thumbnail');
        for (var i = 0; i < thumbnails.length; i++) {
          thumbnails[i].classList.remove('active');
        }
        
        // Tambahkan kelas active ke thumbnail yang diklik
        element.classList.add('active');
      }
      
      // Fungsi untuk accordion
      function toggleAccordion(element) {
        // Toggle active class pada header
        element.classList.toggle('active');
        
        // Dapatkan konten accordion
        var content = element.nextElementSibling;
        
        // Toggle active class pada konten
        content.classList.toggle('active');
      }
      
      // Buka accordion pertama secara default
      document.addEventListener('DOMContentLoaded', function() {
        var firstAccordion = document.querySelector('.accordion-header');
        if (firstAccordion) {
          firstAccordion.classList.add('active');
          firstAccordion.nextElementSibling.classList.add('active');
        }
      });
    </script>

    <!-- Elfsight WhatsApp Chat -->
    <script
      src="https://static.elfsight.com/platform/platform.js"
      async
    ></script>
    <div
      class="elfsight-app-1c150e27-6597-4113-becd-79df393b9756"
      data-elfsight-app-lazy
    ></div>

    <script>
      feather.replace();
    </script>
  </body>
</html>

<?php
$conn->close();
?>