<?php
include '../connection.php';

// Query SQL
$query = "SELECT
            o.id,
            o.nama,
            o.telepon,
            o.email,
            o.wilayah,
            o.alamat,
            o.mtdBayar,
            o.order_date,
            o.status,
            GROUP_CONCAT(oi.product_id) AS product_id,
            GROUP_CONCAT(p.variant) AS variant,
            GROUP_CONCAT(oi.quantity) AS quantity,
            SUM(oi.harga_orders) AS harga_orders
        FROM
            orders o
        JOIN
            order_items oi ON o.id = oi.order_id
        JOIN
            products p ON oi.product_id = p.id
        GROUP BY
            o.id, o.nama, o.telepon, o.email, o.wilayah, o.alamat, o.mtdBayar, o.order_date, o.status";

$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<div id='orders' class='container py-4 table-responsive'>
    <h3 class='text-center fw-bold'>DAFTAR PEMESANAN</h3>";
    $row_admin = mysqli_fetch_object(mysqli_query($db, "SELECT * FROM admin WHERE id='$_GET[id]'"));
    echo "<form class='mb-3 float-end' role='search' action='search-orders.php' method='get'>
            <div class='search'>
                <?php \$tcari = isset(\$_GET['tcari']) ? \$_GET['tcari'] : ''; ?>
                <input id='searchInput' type='text' name='tcari' value='" . htmlspecialchars($_GET['tcari'] ?? '', ENT_QUOTES) . "' class='form-control' placeholder='Search...' aria-label='Search'>
                <!-- Menambahkan input tersembunyi untuk menyertakan ID -->
                <input type='hidden' name='id' value='" . htmlspecialchars($row_admin->id, ENT_QUOTES) . "'>
                <button id='searchButton' type='submit'>
                    <img src='../public/images/search.svg' width='20px' alt='search'>
                </button>
            </div>
        </form>
    <table class='table table-hover text-center' data-aos='fade-down'>
            <tr class='table-dark'>
                <th>No</th>
                <th>Id</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Wilayah</th>
                <th>Alamat</th>
                <th>Variant</th>
                <th>Variant ID</th>
                <th>Quantity</th>
                <th>Harga</th>
                <th>Metode Pembayaran</th>
                <th>Waktu Order</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>";
    $no = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $no++;
        echo "<tr>
                <td>" . $no . "</td>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nama"] . "</td>
                <td>" . $row["telepon"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["wilayah"] . "</td>
                <td>" . $row["alamat"] . "</td>
                <td>" . $row["variant"] . "</td>
                <td>" . $row["product_id"] . "</td>
                <td>" . $row["quantity"] . "</td>
                <td>" . $row["harga_orders"] . "</td>
                <td>" . $row["mtdBayar"] . "</td>
                <td>" . $row["order_date"] . "</td>
                <td>
                    <form action='orders-update.php' method='post' onsubmit='return confirmUpdate()'>
                        <input type='hidden' name='order_id' value='" . $row['id'] . "'>
                        <select name='status' onchange='this.form.submit()'>
                            <option value='Menunggu Bukti Pembayaran'" . ($row['status'] == 'Menunggu Bukti Pembayaran' ? ' selected' : '') . ">Menunggu Bukti Pembayaran</option>
                            <option value='Bukti Bayar Terkonfirmasi'" . ($row['status'] == 'Bukti Bayar Terkonfirmasi' ? ' selected' : '') . ">Bukti Bayar Terkonfirmasi</option>
                            <option value='Pesanan Diproses'" . ($row['status'] == 'Pesanan Diproses' ? ' selected' : '') . ">Pesanan Diproses</option>
                            <option value='Pesanan Diantar'" . ($row['status'] == 'Pesanan Diantar' ? ' selected' : '') . ">Pesanan Diantar</option>
                            <option value='Pesanan Diterima'" . ($row['status'] == 'Pesanan Diterima' ? ' selected' : '') . ">Pesanan Diterima</option>
                            <option value='Pesanan Ditolak'" . ($row['status'] == 'Pesanan Ditolak' ? ' selected' : '') . ">Pesanan Ditolak</option>
                        </select>
                    </form>
                </td>
                <td>
                <a class='btn btn-danger' href='orders-delete.php?delete_id=" . $row['id'] . "' onclick='return confirm(\"Yakin ingin menghapus order ini?\")'>Delete</a>
                </td>
            </tr>";
    }
    echo "</table>
    </div>";
} else {
    echo "Belum ada data";
}
mysqli_close($db);
?>

<script>
function confirmUpdate() {
    return confirm('Yakin ingin mengubah status order?');
}
</script>