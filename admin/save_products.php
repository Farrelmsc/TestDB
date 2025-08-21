<?php
include "koneksi.php";

// File: save_product.php
session_start();

// Include koneksi
include "koneksi.php";

// Fungsi untuk upload gambar
function uploadImage($file, $target_dir) {
    // Buat direktori jika belum ada
    if (!file_exists($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            return ["success" => false, "message" => "Gagal membuat direktori."];
        }
    }
    
    // Generate unique filename
    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $filename = uniqid() . '_' . time() . '.' . $imageFileType;
    $target_file = $target_dir . $filename;
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        return ["success" => false, "message" => "File bukan gambar."];
    }
    
    // Check file size (5MB max)
    if ($file["size"] > 5000000) {
        return ["success" => false, "message" => "Ukuran file terlalu besar (maksimal 5MB)."];
    }
    
    // Allow certain file formats
    $allowed_types = ["jpg", "png", "jpeg", "gif"];
    if(!in_array($imageFileType, $allowed_types)) {
        return ["success" => false, "message" => "Hanya file JPG, JPEG, PNG & GIF yang diizinkan."];
    }
    
    // Try to upload file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ["success" => true, "path" => $target_file];
    } else {
        return ["success" => false, "message" => "Terjadi kesalahan saat mengupload file."];
    }
}

// Proses form jika data dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    
    // Upload gambar utama jika ada
    $main_image_path = "";
    if (!empty($_FILES["main_image"]["name"]) && $_FILES["main_image"]["error"] == UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($_FILES["main_image"], "uploads/");
        if ($uploadResult["success"]) {
            $main_image_path = $uploadResult["path"];
        } else {
            $_SESSION['error'] = $uploadResult["message"];
            header("Location: admin_products.php");
            exit();
        }
    } elseif ($product_id > 0) {
        // Jika edit produk dan tidak ada gambar baru, pertahankan gambar lama
        $result = $conn->query("SELECT main_image FROM products WHERE id = $product_id");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $main_image_path = $row['main_image'];
        }
    }
    
    // Upload gambar gallery
    $gallery_images = [];
    if (!empty($_FILES["gallery_images"]["name"][0]) && $_FILES["gallery_images"]["error"][0] == UPLOAD_ERR_OK) {
        foreach ($_FILES["gallery_images"]["tmp_name"] as $key => $tmp_name) {
            if ($_FILES["gallery_images"]["error"][$key] === UPLOAD_ERR_OK) {
                $file = [
                    "name" => $_FILES["gallery_images"]["name"][$key],
                    "type" => $_FILES["gallery_images"]["type"][$key],
                    "tmp_name" => $tmp_name,
                    "error" => $_FILES["gallery_images"]["error"][$key],
                    "size" => $_FILES["gallery_images"]["size"][$key]
                ];
                
                $uploadResult = uploadImage($file, "uploads/gallery/");
                if ($uploadResult["success"]) {
                    $gallery_images[] = $uploadResult["path"];
                }
            }
        }
    } elseif ($product_id > 0) {
        // Jika edit produk dan tidak ada gambar gallery baru, pertahankan gambar lama
        $result = $conn->query("SELECT gallery_images FROM products WHERE id = $product_id");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $gallery_images = json_decode($row['gallery_images'], true) ?: [];
        }
    }
    
    // Escape data untuk mencegah SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $model = $conn->real_escape_string($_POST['model']);
    $series = $conn->real_escape_string($_POST['series']);
    $engine_type = $conn->real_escape_string($_POST['engine_type']);
    $short_description = $conn->real_escape_string($_POST['short_description']);
    $status = $conn->real_escape_string($_POST['status']);
    $displacement = $conn->real_escape_string($_POST['displacement']);
    $power = $conn->real_escape_string($_POST['power']);
    $torque = $conn->real_escape_string($_POST['torque']);
    $transmission = $conn->real_escape_string($_POST['transmission']);
    $tire = $conn->real_escape_string($_POST['tire']);
    $wheelbase = $conn->real_escape_string($_POST['wheelbase']);
    $fuel_capacity = $conn->real_escape_string($_POST['fuel_capacity']);
    $overview_content = $conn->real_escape_string($_POST['overview_content']);
    $specification_content = $conn->real_escape_string($_POST['specification_content']);
    $application_content = $conn->real_escape_string($_POST['application_content']);
    $gallery_images_json = $conn->real_escape_string(json_encode($gallery_images));
    
    if ($product_id > 0) {
        // Update produk yang sudah ada
        $sql = "UPDATE products SET 
                name = '$name', 
                model = '$model', 
                series = '$series', 
                engine_type = '$engine_type', 
                short_description = '$short_description', 
                status = '$status', 
                displacement = '$displacement', 
                power = '$power', 
                torque = '$torque', 
                transmission = '$transmission', 
                tire = '$tire', 
                wheelbase = '$wheelbase', 
                fuel_capacity = '$fuel_capacity', 
                overview_content = '$overview_content', 
                specification_content = '$specification_content', 
                application_content = '$application_content', 
                main_image = '$main_image_path', 
                gallery_images = '$gallery_images_json',
                updated_at = NOW()
                WHERE id = $product_id";
    } else {
        // Insert produk baru
        $sql = "INSERT INTO products (name, model, series, engine_type, short_description, status, displacement, power, torque, transmission, tire, wheelbase, fuel_capacity, overview_content, specification_content, application_content, main_image, gallery_images) 
                VALUES ('$name', '$model', '$series', '$engine_type', '$short_description', '$status', '$displacement', '$power', '$torque', '$transmission', '$tire', '$wheelbase', '$fuel_capacity', '$overview_content', '$specification_content', '$application_content', '$main_image_path', '$gallery_images_json')";
    }
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Produk berhasil " . ($product_id > 0 ? "diupdate" : "ditambahkan");
    } else {
        $_SESSION['error'] = "Error: " . $conn->error;
    }
    
    $conn->close();
    header("Location: admin_products.php");
    exit();
}

$conn->close();
header("Location: admin_products.php");
exit();
?>