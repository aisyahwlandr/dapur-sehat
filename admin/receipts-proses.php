<?php
include '../connection.php';

if ($_GET['aksi'] == 'insert') {
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
        echo "<script>
                alert('File bukan gambar.');
                window.location.href = '../public/pembayaran.php';
                </script>";
        $uploadOk = 0;
        exit(); // Menghentikan eksekusi skrip PHP setelah menampilkan popup
    }

    // Check file size
    if ($bukti["size"] > 5000000) {
        echo "<script>
                alert('Maaf, file Anda terlalu besar.');
                window.location.href = '../public/pembayaran.php';
                </script>";
        $uploadOk = 0;
        exit(); // Menghentikan eksekusi skrip PHP setelah menampilkan popup
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<script>
                alert('File bukan gambar.');
                window.location.href = '../public/pembayaran.php';
                </script>";
        $uploadOk = 0;
        exit(); // Menghentikan eksekusi skrip PHP setelah menampilkan popup
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>
                alert('Maaf, file Anda belum diunggah.');
                window.location.href = '../public/pembayaran.php';
                </script>";
        exit(); // Menghentikan eksekusi skrip PHP setelah menampilkan popup
    }

    if (move_uploaded_file($_FILES["bktBayar"]["tmp_name"], $target_file)) {
        // Insert into database
        $insertQuery = "INSERT INTO receipts (telepon, bktBayar) VALUES ('$telepon', '$path_bktBayar')";
        $result = mysqli_query($db, $insertQuery);

        if ($result) {
            echo "<script>
                    alert('Terima Kasih, Bukti Bayar Berhasil Diunggah');
                    window.location.href = '../public/pembayaran.php';
                    </script>";
        } else {
            echo "<script>
                    alert('Error: " . mysqli_error($db) . "');
                    window.location.href = '../public/pembayaran.php';
                    </script>";
        }
    } else {
        echo "<script>
                alert('Maaf, terjadi kesalahan saat mengunggah file Anda.');
                window.location.href = '../public/pembayaran.php';
                </script>";
    }
}
?>
