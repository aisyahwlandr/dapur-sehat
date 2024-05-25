<?php
include '../connection.php';

// Mendapatkan data dari form dan melakukan sanitasi
$nama = $db->real_escape_string($_POST['nama']);
$telepon = $db->real_escape_string($_POST['telepon']);
$email = $db->real_escape_string($_POST['email']);
$wilayah = $db->real_escape_string($_POST['wilayah']);
$alamat = $db->real_escape_string($_POST['alamat']);
$variant_orders = $db->real_escape_string($_POST['variant_orders']);
$quantity = intval($_POST['quantity']);
$harga_orders = intval($_POST['harga_orders']);
$mtdBayar = $db->real_escape_string($_POST['mtdBayar']);

// Mendapatkan harga produk dan stok berdasarkan variant
$sql = "SELECT id, harga, stock FROM products WHERE variant = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("s", $variant_orders);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Ambil data produk
    $row = $result->fetch_assoc();
    $product_id = $row['id'];
    $harga = $row['harga'];
    $stock = $row['stock'];

    // Cek apakah stok mencukupi
    if ($stock >= $quantity) {
        // Mengurangi stok produk
        $new_stock = $stock - $quantity;
        $update_stock_sql = "UPDATE products SET stock = ? WHERE id = ?";
        $update_stmt = $db->prepare($update_stock_sql);
        $update_stmt->bind_param("ii", $new_stock, $product_id);

        if ($update_stmt->execute()) {
            // Memasukkan data ke dalam tabel orders
            $insert_order_sql = "INSERT INTO orders (nama, telepon, email, wilayah, alamat, variant_orders, product_id, quantity, harga_orders, mtdBayar)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insert_stmt = $db->prepare($insert_order_sql);
            $insert_stmt->bind_param("ssssssiiis", $nama, $telepon, $email, $wilayah, $alamat, $variant_orders, $product_id, $quantity, $harga_orders, $mtdBayar);

            if ($insert_stmt->execute()) {
                // Pesanan berhasil dilakukan!
            } else {
                echo '<script type="text/javascript">
                    alert("Error: ' . $insert_stmt->error . '");
                </script>';
            }
        } else {
            echo '<script type="text/javascript">
                    alert("Error: ' . $update_stmt->error . '");
                </script>';
        }
    } else {
        echo '<script type="text/javascript">
                    alert("Stok produk tidak mencukupi!");
                </script>';
    }
} else {
    echo '<script type="text/javascript">
                    alert("Produk tidak ditemukan!");
                </script>';
}

$stmt->close();
$db->close();
