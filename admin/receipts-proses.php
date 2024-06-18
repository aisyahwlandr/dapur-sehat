<?php
include '../connection.php';

if ($_GET['aksi'] == 'insert') {
    $telepon = $_POST['telepon'];
    $bukti = $_FILES['bktBayar'];

    // Check if phone number exists in the database
    $phoneCheckQuery = "SELECT * FROM orders WHERE telepon = '$telepon'";
    $phoneCheckResult = mysqli_query($db, $phoneCheckQuery);

    if (mysqli_num_rows($phoneCheckResult) == 0) {
        header("Location: ../public/pembayaran.php?error=nomor_telepon");
        exit();
    }

    // Handle file upload
    if ($bukti['error'] == UPLOAD_ERR_NO_FILE) {
        header("Location: ../public/pembayaran.php?error=upload_gagal");
        exit(); // Menghentikan eksekusi skrip PHP setelah menampilkan popup
    }

    date_default_timezone_set('Asia/Jakarta');
    $timestamp = date("Y-m-d_H-i-s");
    $target_dir = "uploads/receipts/";
    $target_file = $target_dir . $timestamp . "_" . basename($bukti["name"]);
    $path_bktBayar = $timestamp . "_" . basename($bukti["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($bukti["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        header("Location: ../public/pembayaran.php?error=file_bukan_gambar");
        $uploadOk = 0;
        exit(); // Menghentikan eksekusi skrip PHP setelah menampilkan popup
    }

    // Check file size
    if ($bukti["size"] > 5000000) {
        header("Location: ../public/pembayaran.php?error=file_terlalu_besar");
        $uploadOk = 0;
        exit(); // Menghentikan eksekusi skrip PHP setelah menampilkan popup
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        header("Location: ../public/pembayaran.php?error=format_tidak_valid");
        $uploadOk = 0;
        exit(); // Menghentikan eksekusi skrip PHP setelah menampilkan popup
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        header("Location: ../public/pembayaran.php?error=upload_gagal");
        exit(); // Menghentikan eksekusi skrip PHP setelah menampilkan popup
    }

    if (move_uploaded_file($_FILES["bktBayar"]["tmp_name"], $target_file)) {
        // Insert into database
        $insertQuery = "INSERT INTO receipts (telepon, bktBayar) VALUES ('$telepon', '$path_bktBayar')";
        $result = mysqli_query($db, $insertQuery);

        if ($result) {
            header("Location: ../public/index.php?success=upload_berhasil");
        } else {
            header("Location: ../public/pembayaran.php?error=" . mysqli_error($db));
        }
    } else {
        header("Location: ../public/pembayaran.php?error=upload_error");
    }
}
?>
