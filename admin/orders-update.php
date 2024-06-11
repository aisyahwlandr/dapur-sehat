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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = mysqli_real_escape_string($db, $_POST['order_id']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    
    $update_query = "UPDATE orders SET status = '$status' WHERE id = '$order_id'";
    
    if (mysqli_query($db, $update_query)) {
        header("Location: dashboard.php?id=$id&page=orders");
    } else {
        echo "Error updating record: " . mysqli_error($db);
    }
    
    mysqli_close($db);
}
?>
