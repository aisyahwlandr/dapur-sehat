<?php
include '../connection.php';

$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$email = $_POST['email'];
$wilayah = $_POST['wilayah'];
$alamat = $_POST['alamat'];
$mtdBayar = $_POST['mtdBayar'];

$product_ids = $_POST['product_id'];

// Memasukkan data pemesan ke dalam tabel orders
$sql_order = "INSERT INTO orders (nama, telepon, email, wilayah, alamat, mtdBayar)
                VALUES ('$nama', '$telepon', '$email', '$wilayah', '$alamat', '$mtdBayar')";
if ($db->query($sql_order) === TRUE) {
    $order_id = $db->insert_id; // Mendapatkan ID pesanan yang baru saja dimasukkan

    // Proses setiap produk yang dipesan
    foreach ($_POST['quantity'] as $product_id => $quantity) {
        // Periksa apakah checkbox produk terkait telah dicentang
        if (isset($_POST['product_id'][$product_id])) {
            // Ambil harga produk dari database
            $sql_price = "SELECT harga FROM products WHERE id = $product_id";
            $result = $db->query($sql_price);
            $row = $result->fetch_assoc();
            $harga = $row['harga'];

            // Memasukkan detail pesanan ke dalam tabel order_items
            $sql_order_item = "INSERT INTO order_items (order_id, product_id, variant, quantity, harga_orders)
                                VALUES ('$order_id', '$product_id', 'variant_placeholder', '$quantity', '$harga' * '$quantity')";
            if ($db->query($sql_order_item) === TRUE) {
                // Lakukan pengurangan stok produk
                $sql_update_stock = "UPDATE products SET stock = stock - '$quantity' WHERE id = '$product_id'";
                if ($db->query($sql_update_stock) !== TRUE) {
                    echo "Error updating stock: " . $db->error;
                }
            } else {
                echo "Error: " . $sql_order_item . "<br>" . $db->error;
            }
        }
    }

    // Tutup koneksi ke database
    $db->close();

    // Redirect ke halaman pembayaran
    header("Location: ../public/pembayaran.php");
    exit();
} else {
    echo "Error: " . $sql_order . "<br>" . $db->error;
}
