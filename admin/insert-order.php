<?php
include 'connection.php';

$variant_orders = $_POST['variant_orders'];
$quantity = $_POST['quantity'];
$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$email = $_POST['email'];
$wilayah = $_POST['wilayah'];
$alamat = $_POST['alamat'];
$mtdBayar = $_POST['mtdBayar'];

// Validasi input
if (!empty($variant_orders) && $quantity > 0 && !empty($nama) && !empty($telepon) && !empty($wilayah) && !empty($alamat) && !empty($mtdBayar)) {
    // Memeriksa stok yang tersedia berdasarkan nama variant
    $stmt = $conn->prepare("SELECT id, harga, stock FROM products WHERE variant = ?");
    $stmt->bind_param("s", $variant_orders);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_id = $row['id'];
        $harga = $row['harga'];
        $available_stock = $row['stock'];

        if ($available_stock >= $quantity) {
            // Mengurangi stok
            $new_stock = $available_stock - $quantity;
            $stmt_update = $conn->prepare("UPDATE products SET stock = ? WHERE id = ?");
            $stmt_update->bind_param("ii", $new_stock, $product_id);

            if ($stmt_update->execute()) {
                // Menyimpan pesanan
                $harga_orders = $harga * $quantity;
                $stmt_insert = $conn->prepare("INSERT INTO orders (nama, telepon, email, wilayah, alamat, variant_orders, quantity, harga_orders, mtdBayar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt_insert->bind_param("ssssssids", $nama, $telepon, $email, $wilayah, $alamat, $variant_orders, $quantity, $harga_orders, $mtdBayar);

                if ($stmt_insert->execute()) {
                    echo "Order berhasil disimpan.";
                } else {
                    echo "Error: " . $stmt_insert->error;
                }

                $stmt_insert->close();
            } else {
                echo "Error updating stock: " . $stmt_update->error;
            }

            $stmt_update->close();
        } else {
            echo "Stok tidak mencukupi.";
        }
    } else {
        echo "Variant tidak ditemukan.";
    }

    $stmt->close();
} else {
    echo "Data tidak valid. Pastikan semua field diisi dengan benar.";
}

$conn->close();
?>
