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

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Hapus terlebih dahulu baris-baris terkait di tabel order_items
    $delete_order_items_query = "DELETE FROM order_items WHERE order_id=$delete_id";
    if (mysqli_query($db, $delete_order_items_query)) {
        // Setelah menghapus baris-baris terkait, hapus baris di tabel orders
        $delete_order_query = "DELETE FROM orders WHERE id=$delete_id";
        if (mysqli_query($db, $delete_order_query)) {
            // Redirect kembali ke halaman dashboard atau halaman order setelah penghapusan
            header("Location: dashboard.php?id=$id&page=orders");
            exit();
        } else {
            // Jika gagal menghapus baris di tabel orders
            echo "Gagal menghapus order.";
        }
    } else {
        // Jika gagal menghapus baris-baris terkait di tabel order_items
        echo "Gagal menghapus item pesanan yang terkait.";
    }
} else {
    header("Location: dashboard.php?id=$id&page=orders");
    exit();
}
?>
