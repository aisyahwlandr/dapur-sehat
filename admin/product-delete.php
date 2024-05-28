<?php
session_start();
include '../connection.php';

// Periksa apakah sesi email telah disetel
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
    header("Location: ../auth/auth.php");
    exit();
}

// Validasi ID yang ada di URL dengan ID yang ada di sesi
$id = $_SESSION['id'];

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Hapus data produk berdasarkan ID
    $delete_query = "DELETE FROM products WHERE id=$delete_id";
    if (mysqli_query($db, $delete_query)) {
        // Redirect kembali ke halaman dashboard atau halaman produk setelah penghapusan
        header("Location: dashboard.php?id=$id&page=products");
        exit();
    } else {
        // Jika gagal menghapus, mungkin tindakan apa yang perlu diambil? 
        echo "Gagal menghapus produk.";
    }
} else {
    header("Location: dashboard.php?id=$id&page=products");
    exit();
}
?>
