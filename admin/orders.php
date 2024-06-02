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
    echo "<div id='orders' class='container py-4'>
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
    <div class='clearfix'></div>
    <div class='table-responsive'>
    <table class='table table-hover text-center' data-aos='fade-down'>
            <tr class='table-dark'>
                <th>No</th>
                <th>Id</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Variant</th>
                <th>Quantity</th>
                <th>Harga</th>
                <th>Metode Pembayaran</th>
                <th>Waktu Order</th>
                <th>Status</th>
                <th>Detail</th>
                <th>Aksi</th>
            </tr>";
    $no = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $no++;
        $detail_id = "detail_" . $row["id"];
        echo "<tr>
                <td>" . $no . "</td>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nama"] . "</td>
                <td>" . $row["telepon"] . "</td>
                <td>" . $row["variant"] . "</td>
                <td>" . $row["quantity"] . "</td>
                <td>" . $row["harga_orders"] . "</td>
                <td>" . $row["mtdBayar"] . "</td>
                <td>" . $row["order_date"] . "</td>
                <td>
                    <form action='orders-update.php' method='post' onsubmit='return confirmUpdate()'>
                        <input type='hidden' name='order_id' value='" . $row['id'] . "'>
                        <select name='status' onchange='confirmStatusUpdate(this)'>
                            <option value='Menunggu Bukti Pembayaran'" . ($row['status'] == 'Menunggu Bukti Pembayaran' ? ' selected' : '') . ">Menunggu Bukti Pembayaran</option>
                            <option value='Bukti Bayar Terkonfirmasi'" . ($row['status'] == 'Bukti Bayar Terkonfirmasi' ? ' selected' : '') . ">Bukti Bayar Terkonfirmasi</option>
                            <option value='Pesanan Diproses'" . ($row['status'] == 'Pesanan Diproses' ? ' selected' : '') . ">Pesanan Diproses</option>
                            <option value='Pesanan Diantar'" . ($row['status'] == 'Pesanan Diantar' ? ' selected' : '') . ">Pesanan Diantar</option>
                            <option value='Pesanan Diterima Pemesan'" . ($row['status'] == 'Pesanan Diterima Pemesan' ? ' selected' : '') . ">Pesanan Diterima Pemesan</option>
                            <option value='Harap Kirim Ulang Bukti Bayar'" . ($row['status'] == 'Harap Kirim Ulang Bukti Bayar' ? ' selected' : '') . ">Harap Kirim Ulang Bukti Bayar</option>
                        </select>
                    </form>
                </td>
                <td>
                    <button class='btn btn-primary text-white' data-bs-toggle='modal' data-bs-target='#" . $detail_id . "'>Detail</button>
                </td>
                <td>
                <a class='btn btn-danger' href='orders-delete.php?delete_id=" . $row['id'] . "' onclick='return confirmDelete()'>Delete</a>
                </td>
            </tr>";

        // Modal
        echo "<div class='modal fade' id='" . $detail_id . "' tabindex='-1' aria-labelledby='" . $detail_id . "Label' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='" . $detail_id . "Label'>Detail Order ID: " . $row["id"] . "</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <div><strong>No:</strong> " . $no . "</div>
                            <div><strong>Nama:</strong> " . $row["nama"] . "</div>
                            <div><strong>Telepon:</strong> " . $row["telepon"] . "</div>
                            <div><strong>Email:</strong> " . $row["email"] . "</div>
                            <div><strong>Wilayah:</strong> " . $row["wilayah"] . "</div>
                            <div><strong>Alamat:</strong> " . $row["alamat"] . "</div>
                            <div><strong>Variant:</strong> " . $row["variant"] . "</div>
                            <div><strong>Variant ID:</strong> " . $row["product_id"] . "</div>
                            <div><strong>Quantity:</strong> " . $row["quantity"] . "</div>
                            <div><strong>Harga:</strong> " . $row["harga_orders"] . "</div>
                            <div><strong>Metode Pembayaran:</strong> " . $row["mtdBayar"] . "</div>
                            <div><strong>Waktu Order:</strong> " . $row["order_date"] . "</div>
                            <div><strong>Status:</strong> " . $row["status"] . "</div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        </div>
                    </div>
                </div>
            </div>";
    }
    echo "</table>
    </div>
    </div>";
} else {
    echo "Belum ada data";
}
mysqli_close($db);
?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
<script>
    function confirmStatusUpdate(selectElement) {
        if (confirm('Yakin ingin mengubah status order?')) {
            selectElement.form.submit();
        } else {
            // Jika pembatalan, kembalikan ke status sebelumnya
            selectElement.value = selectElement.dataset.previousValue;
        }
    }

    function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');
        }
</script>