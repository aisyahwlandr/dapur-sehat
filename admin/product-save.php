<?php
session_start();
include '../connection.php';

// Periksa apakah sesi username telah disetel
if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: ../auth/auth.php");
    exit();
}

// Validasi ID yang ada di URL dengan ID yang ada di sesi
$id = $_SESSION['id'];

// Proses penyimpanan data produk
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $variant = $_POST['variant'];
    $harga = $_POST['harga'];
    $isi = $_POST['isi'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    // Proses upload gambar
    $photo1 = $_FILES['photo1']['name'];
    $photo2 = $_FILES['photo2']['name'];
    $photo3 = $_FILES['photo3']['name'];
    $target_dir = "uploads/products/";
    $target_file1 = $target_dir . basename($photo1);
    $target_file2 = $target_dir . basename($photo2);
    $target_file3 = $target_dir . basename($photo3);
    move_uploaded_file($_FILES["photo1"]["tmp_name"], $target_file1);
    move_uploaded_file($_FILES["photo2"]["tmp_name"], $target_file2);
    move_uploaded_file($_FILES["photo3"]["tmp_name"], $target_file3);

    // Jika ini permintaan update
    if (isset($_GET['update_id'])) {
        $update_id = $_GET['update_id'];
        // Proses update data di database
        $query = "UPDATE products SET 
                variant='$variant', 
                photo1='$photo1', 
                photo2='$photo2', 
                photo3='$photo3', 
                harga='$harga', 
                isi='$isi', 
                deskripsi='$deskripsi', 
                stock='$stock' 
                WHERE id='$update_id'";
        if (mysqli_query($db, $query)) {
            header("Location: dashboard.php?id=$id&page=products&success=1");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($db);
        }
    } else {
        //jika permintaan tambah/insert
        // Simpan data ke database
        $query = "INSERT INTO products (variant, photo1, photo2, photo3, harga, isi, deskripsi, stock) 
            VALUES ('$variant', '$photo1', '$photo2', '$photo3', '$harga', '$isi', '$deskripsi', '$stock')";
        if (mysqli_query($db, $query)) {
            header("Location: dashboard.php?id=$id&page=products&success=1");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($db);
        }
    }
} else {
    header("Location: dashboard.php?id=$id&page=products");
    exit();
}
