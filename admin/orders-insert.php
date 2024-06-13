<?php
include '../connection.php';

$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$email = $_POST['email'];
$wilayah = $_POST['wilayah'];
$alamat = $_POST['alamat'];
$mtdBayar = $_POST['mtdBayar'];
$variant = "SELECT variant FROM products WHERE id = $product_id";

$product_ids = $_POST['product_id'];
$quantities = $_POST['quantity'];

// Periksa stok sebelum memasukkan data ke dalam database
foreach ($quantities as $product_id => $quantity) {
    $sql_check_stock = "SELECT stock FROM products WHERE id = $product_id";
    $result_stock = $db->query($sql_check_stock);
    $row_stock = $result_stock->fetch_assoc();

    if ($quantity > $row_stock['stock']) {
        echo "<script>
                alert('Jumlah pesanan melebihi stok untuk produk dengan ID: $product_id');
                window.history.back();
            </script>";
        exit();
    }
}

// Memasukkan data pemesan ke dalam tabel orders
$sql_order = "INSERT INTO orders (nama, telepon, email, wilayah, alamat, mtdBayar)
                VALUES ('$nama', '$telepon', '$email', '$wilayah', '$alamat', '$mtdBayar')";
if ($db->query($sql_order) === TRUE) {
    $order_id = $db->insert_id; // Mendapatkan ID pesanan yang baru saja dimasukkan

    // Proses setiap produk yang dipesan
    foreach ($quantities as $product_id => $quantity) {
        // Periksa apakah checkbox produk terkait telah dicentang
        if (isset($product_ids[$product_id])) {
            // Ambil nama variant dari database berdasarkan product ID
            $sql_variant = "SELECT variant FROM products WHERE id = $product_id";
            $result_variant = $db->query($sql_variant);

            // Periksa apakah query berhasil dieksekusi
            if ($result_variant) {
                // Ambil baris hasil dari query
                $row_variant = $result_variant->fetch_assoc();

                // Ambil nama variant dari hasil query
                $variant = $row_variant['variant'];

                // Ambil harga produk dari database
                $sql_price = "SELECT harga FROM products WHERE id = $product_id";
                $result = $db->query($sql_price);
                $row = $result->fetch_assoc();
                $harga = $row['harga'];

                // Memasukkan detail pesanan ke dalam tabel order_items
                $sql_order_item = "INSERT INTO order_items (order_id, product_id, variant, quantity, harga_orders)
                                VALUES ('$order_id', '$product_id', '$variant', '$quantity', '$harga' * '$quantity')";
                if ($db->query($sql_order_item) === TRUE) {
                    // Lakukan pengurangan stok produk
                    $sql_update_stock = "UPDATE products SET stock = stock - '$quantity' WHERE id = '$product_id'";
                    if ($db->query($sql_update_stock) !== TRUE) {
                        echo "Error updating stock: " . $db->error;
                    }
                } else {
                    echo "Error: " . $sql_order_item . "<br>" . $db->error;
                }
            } else {
                // Menangani jika query tidak berhasil dieksekusi
                echo "Error getting variant: " . $db->error;
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
