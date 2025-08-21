<?php
session_start();
// Include koneksi dan dapatkan variabel $conn
$conn = include "koneksi.php";

// Fungsi untuk mendapatkan semua produk
function getProducts($connection) {
    $sql = "SELECT * FROM products ORDER BY created_at DESC";
    $result = $connection->query($sql);
    
    $products = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}

// Fungsi untuk mendapatkan produk berdasarkan ID
function getProductById($connection, $id) {
    $stmt = $connection->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

// Tangani aksi edit dan hapus
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = intval($_GET['id']);
    
    if ($action == 'edit') {
        $editProduct = getProductById($conn, $id);
    } elseif ($action == 'delete') {
        // Tangani penghapusan produk
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Produk berhasil dihapus";
            header("Location: admin_products.php");
            exit();
        } else {
            $_SESSION['error'] = "Gagal menghapus produk: " . $conn->error;
            header("Location: admin_products.php");
            exit();
        }
    }
}

// Ambil semua produk untuk ditampilkan
$products = getProducts($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin Produk - Sales Hino Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --hino-blue: #0051a2;
            --hino-light-blue: #e6f0fa;
            --hino-dark: #333;
            --hino-gray: #f5f5f5;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        
        .sidebar {
            background-color: var(--hino-blue);
            color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1rem;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .admin-card {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border: none;
        }
        
        .admin-card-header {
            background-color: var(--hino-blue);
            color: white;
            border-radius: 8px 8px 0 0 !important;
        }
        
        .btn-hino {
            background-color: var(--hino-blue);
            color: white;
        }
        
        .btn-hino:hover {
            background-color: #003d7a;
            color: white;
        }
        
        .spec-table th {
            background-color: var(--hino-light-blue);
            width: 30%;
        }
        
        .product-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        
        .nav-tabs .nav-link {
            color: var(--hino-dark);
            font-weight: 500;
        }
        
        .nav-tabs .nav-link.active {
            color: var(--hino-blue);
            border-bottom: 3px solid var(--hino-blue);
            border-top: none;
            border-left: none;
            border-right: none;
            background: transparent;
        }
        
        .image-preview {
            height: 150px;
            width: 100%;
            object-fit: cover;
            border: 1px dashed #ccc;
            padding: 5px;
            border-radius: 5px;
        }
        
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
        }
    </style>
</head>
<body>
    <!-- Notifikasi -->
    <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['message']); endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['error']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error']); endif; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-4">
                    <h4 class="text-center">Sales Hino</h4>
                    <p class="text-center text-white-50 mb-4">Admin Panel</p>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="fas fa-newspaper me-2"></i> Artikel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_products.php">
                            <i class="fas fa-truck me-2"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-image me-2"></i> Gallery
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog me-2"></i> Pengaturan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Manajemen Produk</h2>
                    <button class="btn btn-hino" data-bs-toggle="modal" data-bs-target="#productModal">
                        <i class="fas fa-plus me-2"></i>Tambah Produk
                    </button>
                </div>

                <!-- Daftar Produk -->
                <div class="card admin-card">
                    <div class="card-header admin-card-header">
                        <h5 class="mb-0">Daftar Produk</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Model</th>
                                        <th>Seri</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php
                                    foreach ($products as $prod):
                                    ?>
                                    <tr>
                                        <td><?php echo $prod['id']; ?></td>
                                        <td><img src="<?php echo $prod['main_image']; ?>" class="img-thumbnail" alt="<?php echo $prod['name']; ?>" style="width: 60px; height: 40px; object-fit: cover;"></td>
                                        <td><?php echo $prod['name']; ?></td>
                                        <td><?php echo $prod['model']; ?></td>
                                        <td><?php echo $prod['series']; ?></td>
                                        <td><span class="badge bg-<?php echo $prod['status'] == 'active' ? 'success' : 'secondary'; ?>"><?php echo $prod['status'] == 'active' ? 'Aktif' : 'Tidak Aktif'; ?></span></td>
                                        <td>
                                            <a href="admin_products.php?action=edit&id=<?php echo $prod['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="../product_detail.php?id=<?php echo $prod['id']; ?>" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="#" onclick="confirmDelete(<?php echo $prod['id']; ?>, '<?php echo addslashes($prod['name']); ?>')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Produk -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo isset($editProduct) ? 'Edit' : 'Tambah'; ?> Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="save_products.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo isset($editProduct) ? $editProduct['id'] : ''; ?>">
                    <div class="modal-body">
                        <ul class="nav nav-tabs" id="productTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab">Informasi Dasar</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab">Spesifikasi</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="content-tab" data-bs-toggle="tab" data-bs-target="#content" type="button" role="tab">Konten</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button" role="tab">Media</button>
                            </li>
                        </ul>
                        
                        <div class="tab-content mt-3" id="productTabContent">
                            <!-- Tab Informasi Dasar -->
                            <div class="tab-pane fade show active" id="basic" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="productName" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control" id="productName" name="name" value="<?php echo isset($editProduct) ? $editProduct['name'] : ''; ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="productModel" class="form-label">Model</label>
                                        <input type="text" class="form-control" id="productModel" name="model" value="<?php echo isset($editProduct) ? $editProduct['model'] : ''; ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="productSeries" class="form-label">Seri</label>
                                        <input type="text" class="form-control" id="productSeries" name="series" value="<?php echo isset($editProduct) ? $editProduct['series'] : ''; ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="productEngine" class="form-label">Tipe Mesin</label>
                                        <input type="text" class="form-control" id="productEngine" name="engine_type" value="<?php echo isset($editProduct) ? $editProduct['engine_type'] : ''; ?>">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="shortDescription" class="form-label">Deskripsi Singkat</label>
                                        <textarea class="form-control" id="shortDescription" name="short_description" rows="3"><?php echo isset($editProduct) ? $editProduct['short_description'] : ''; ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="active" <?php echo (isset($editProduct) && $editProduct['status'] == 'active') ? 'selected' : ''; ?>>Aktif</option>
                                            <option value="inactive" <?php echo (isset($editProduct) && $editProduct['status'] == 'inactive') ? 'selected' : ''; ?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tab Spesifikasi -->
                            <div class="tab-pane fade" id="specs" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="displacement" class="form-label">Displacement</label>
                                        <input type="text" class="form-control" id="displacement" name="displacement" value="<?php echo isset($editProduct) ? $editProduct['displacement'] : ''; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="power" class="form-label">Daya Maksimum (PS/rpm)</label>
                                        <input type="text" class="form-control" id="power" name="power" value="<?php echo isset($editProduct) ? $editProduct['power'] : ''; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="torque" class="form-label">Torsi Maksimum (kgm/rpm)</label>
                                        <input type="text" class="form-control" id="torque" name="torque" value="<?php echo isset($editProduct) ? $editProduct['torque'] : ''; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="transmission" class="form-label">Transmisi</label>
                                        <input type="text" class="form-control" id="transmission" name="transmission" value="<?php echo isset($editProduct) ? $editProduct['transmission'] : ''; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tire" class="form-label">Ban</label>
                                        <input type="text" class="form-control" id="tire" name="tire" value="<?php echo isset($editProduct) ? $editProduct['tire'] : ''; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="wheelbase" class="form-label">Jarak Sumbu Roda</label>
                                        <input type="text" class="form-control" id="wheelbase" name="wheelbase" value="<?php echo isset($editProduct) ? $editProduct['wheelbase'] : ''; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="capacity" class="form-label">Kapasitas Tangki Bahan Bakar</label>
                                        <input type="text" class="form-control" id="capacity" name="fuel_capacity" value="<?php echo isset($editProduct) ? $editProduct['fuel_capacity'] : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tab Konten -->
                            <div class="tab-pane fade" id="content" role="tabpanel">
                                <div class="mb-3">
                                    <label for="overviewContent" class="form-label">Konten Overview</label>
                                    <textarea class="form-control" id="overviewContent" name="overview_content" rows="5"><?php echo isset($editProduct) ? $editProduct['overview_content'] : ''; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="specificationContent" class="form-label">Konten Spesifikasi (Tambahan)</label>
                                    <textarea class="form-control" id="specificationContent" name="specification_content" rows="5"><?php echo isset($editProduct) ? $editProduct['specification_content'] : ''; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="applicationContent" class="form-label">Konten Application</label>
                                    <textarea class="form-control" id="applicationContent" name="application_content" rows="5"><?php echo isset($editProduct) ? $editProduct['application_content'] : ''; ?></textarea>
                                </div>
                            </div>
                            
                            <!-- Tab Media -->
                            <div class="tab-pane fade" id="media" role="tabpanel">
                                <div class="mb-3">
                                    <label for="mainImage" class="form-label">Gambar Utama</label>
                                    <input class="form-control" type="file" id="mainImage" name="main_image">
                                    <div class="mt-2">
                                        <?php if (isset($editProduct) && !empty($editProduct['main_image'])): ?>
                                        <img id="mainImagePreview" src="<?php echo $editProduct['main_image']; ?>" class="image-preview">
                                        <?php else: ?>
                                        <img id="mainImagePreview" src="https://via.placeholder.com/300x200" class="image-preview">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="galleryImages" class="form-label">Gambar Gallery</label>
                                    <input class="form-control" type="file" id="galleryImages" name="gallery_images[]" multiple>
                                    <div class="d-flex flex-wrap gap-2 mt-2" id="galleryPreviews">
                                        <?php if (isset($editProduct) && !empty($editProduct['gallery_images'])): 
                                            $gallery = json_decode($editProduct['gallery_images'], true);
                                            if (is_array($gallery)): 
                                                foreach ($gallery as $image): ?>
                                                <img src="<?php echo $image; ?>" class="image-preview" style="width: 120px;">
                                        <?php endforeach; endif; endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-hino"><?php echo isset($editProduct) ? 'Update' : 'Simpan'; ?> Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview image functionality
        document.getElementById('mainImage')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('mainImagePreview').src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Gallery preview functionality
        document.getElementById('galleryImages')?.addEventListener('change', function(e) {
            const files = e.target.files;
            const previewContainer = document.getElementById('galleryPreviews');
            previewContainer.innerHTML = '';
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.className = 'image-preview';
                        img.style.width = '120px';
                        previewContainer.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                }
            }
        });

        // Fungsi konfirmasi hapus
        function confirmDelete(productId, productName) {
            if (confirm(`Apakah Anda yakin ingin menghapus produk "${productName}"?`)) {
                window.location.href = `admin_products.php?action=delete&id=${productId}`;
            }
        }

        // Buka modal otomatis jika dalam mode edit
        <?php if (isset($editProduct)): ?>
        document.addEventListener('DOMContentLoaded', function() {
            var productModal = new bootstrap.Modal(document.getElementById('productModal'));
            productModal.show();
        });
        <?php endif; ?>

        // Auto-hide alert setelah 5 detik
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                new bootstrap.Alert(alert).close();
            });
        }, 5000);
    </script>
</body>
</html>
<?php
$conn->close();
?>