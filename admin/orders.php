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
    <h3 class='text-center fw-bold'>DAFTAR PEMESANAN</h3>
    <form class='mb-3 float-end' role='search'>
        <div class='search'>
            <input id='searchInput' type='text' class='form-control' placeholder='Search...' aria-label='Search'>
            <button id='searchButton' type='submit'><img src='../public/images/search.svg' width='20px'
                    alt='search'></button>
        </div>
    </form>
    <table class='table table-hover text-center' data-aos='fade-down'>
            <tr class='table-dark'>
                <th>ID</th>
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
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
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
                <td>" . $row["status"] . "</td>
                <td>
                    <a class='btn btn-danger' href='delete_order.php?id=" . $row["id"] . "'>Delete</a>
                </td>
            </tr>";
    }
    echo "</table>
    </div>";
} else {
    echo "0 results";
}
mysqli_close($db);
