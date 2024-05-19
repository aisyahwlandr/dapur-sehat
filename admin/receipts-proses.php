<?php
include '../connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $telepon = $_POST['telepon'];
    $bukti = $_FILES['bktBayar'];

    // Handle file upload
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
        echo "<script>showToast('File bukan gambar.');</script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($bukti["size"] > 5000000) {
        echo "Maaf, file Anda terlalu besar.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<script>showToast('File bukan gambar.');</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>showToast('Maaf, file Anda belum diunggah.');</script>";
    } else {
        if (move_uploaded_file ($_FILES["bktBayar"]["tmp_name"],$target_file)) {
            // Insert into database
            $insertQuery = "INSERT INTO receipts (telepon, bktBayar) VALUES ('$telepon', '$path_bktBayar')";
            $result = mysqli_query($db, $insertQuery);

            if ($result) {
                echo "<script>showToast('Terima Kasih, Bukti Bayar Berhasil Diunggah');</script>";
            } else {
                echo "<script>showToast('Error: " . mysqli_error($db) . "');</script>";
            }
        } else {
            echo "<script>showToast('Maaf, terjadi kesalahan saat mengunggah file Anda.');</script>";
        }
    }
}
?>
