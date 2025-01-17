<?php
session_start();
include '../connection.php';

// Periksa apakah sesi username telah disetel
if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: ../auth/auth.php");
    exit();
}

// Validasi ID yang ada di URL dengan ID yang ada di sesi
$id = $_GET['id'] ?? null;
if ($id !== $_SESSION['id']) {
    header("Location: ../auth/auth.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="dashboard.css">
    <link rel="icon" href="../public/images/logo.png" type="image/x-icon">
    <title>Admin Dapur Sehat</title>
</head>

<body style="background-color: #DADDFC;">
    <header>
        <div class="px-3 py-2 border-bottom" style="background-image: linear-gradient(180deg, rgba(141, 139, 226, 1), rgba(253, 187, 203, 1));">
            <div class="container">
                <div class="py-2 d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <?php
                    $result = mysqli_query($db, "SELECT * FROM admin WHERE id='$_GET[id]'");

                    while ($row = mysqli_fetch_object($result)) {
                    ?>
                        <a href="dashboard.php?id=<?php echo $row->id; ?>" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-blue-custom text-decoration-none">
                            <img width="120px" src="../public/images/logo.png" alt="Logo">
                        </a>
                        <ul class="nav col-12 col-lg-auto my-2 justify-content-center align-items-center my-md-0 text-small">
                            <li>
                                <a href="dashboard.php?id=<?php echo $row->id; ?>" class="nav-link text-blue-custom rounded">
                                    <i class="bi bi-house-door"></i>
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="dashboard.php?id=<?php echo $row->id; ?>&page=products" class="nav-link text-blue-custom rounded">
                                    <i class="bi bi-grid"></i>
                                    Products
                                </a>
                            </li>
                            <li>
                                <a href="dashboard.php?id=<?php echo $row->id; ?>&page=orders" class="nav-link text-blue-custom rounded">
                                    <i class="bi bi-bag"></i>
                                    Orders
                                </a>
                            </li>
                            <li>
                                <a href="dashboard.php?id=<?php echo $row->id; ?>&page=receipts" class="nav-link text-blue-custom rounded">
                                    <i class="bi bi-receipt"></i>
                                    Receipts
                                </a>
                            </li>
                            <li>
                                <p class="navbar-text mt-3 mx-3 fw-bold">
                                    Hi <?php echo $row->username ?> !</p>
                            </li>
                            <li>
                                <a href="../auth/logout.php">
                                    <button id="logoutButton" type="button" class="btn btn-danger">LogOut</button>
                                </a>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>

    <div class="container py-4 table-responsive">
        <main>
            <div class='clearfix'></div>
            <table class="table table-hover text-center" data-aos="fade-down">
                <tr class="table-dark">
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
                </tr>
                <?php
                $no = 0;
                if (isset($_GET['tcari'])) {
                    $keyword = mysqli_real_escape_string($db, $_GET['tcari']);

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
                            WHERE
                                o.nama LIKE '%$keyword%' OR
                                o.telepon LIKE '%$keyword%' OR
                                o.email LIKE '%$keyword%' OR
                                o.wilayah LIKE '%$keyword%' OR
                                o.status LIKE '%$keyword%' OR
                                o.alamat LIKE '%$keyword%' OR
                                p.variant LIKE '%$keyword%'
                            GROUP BY
                                o.id, o.nama, o.telepon, o.email, o.wilayah, o.alamat, o.mtdBayar, o.order_date, o.status";

                    $result = mysqli_query($db, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $no++;
                            $detail_id = "detail_" . $row["id"];
                            echo "<tr>
                                    <td class='align-middle'>" . $no . "</td>
                                    <td class='align-middle'>" . $row["id"] . "</td>
                                    <td class='align-middle'>" . $row["nama"] . "</td>
                                    <td class='align-middle'>" . $row["telepon"] . "</td>
                                    <td class='align-middle'>" . $row["variant"] . "</td>
                                    <td class='align-middle'>" . $row["quantity"] . "</td>
                                    <td class='align-middle'>" . $row["harga_orders"] . "</td>
                                    <td class='align-middle'>" . $row["mtdBayar"] . "</td>
                                    <td class='align-middle'>" . $row["order_date"] . "</td>
                                    <td class='align-middle'>
                                        <form action='orders-update.php' method='post' onsubmit='return confirmUpdate()'>
                                            <input type='hidden' name='order_id' value='" . $row['id'] . "'>
                                            <select name='status' onchange='confirmStatusUpdate(this)' data-previous-value='" . $row['status'] . "'>
                                                <option value='Menunggu Bukti Pembayaran'" . ($row['status'] == 'Menunggu Bukti Pembayaran' ? ' selected' : '') . ">Menunggu Bukti Pembayaran</option>
                                                <option value='Bukti Bayar Terkonfirmasi'" . ($row['status'] == 'Bukti Bayar Terkonfirmasi' ? ' selected' : '') . ">Bukti Bayar Terkonfirmasi</option>
                                                <option value='Pesanan Diproses'" . ($row['status'] == 'Pesanan Diproses' ? ' selected' : '') . ">Pesanan Diproses</option>
                                                <option value='Pesanan Diantar'" . ($row['status'] == 'Pesanan Diantar' ? ' selected' : '') . ">Pesanan Diantar</option>
                                                <option value='Pesanan Diterima Pemesan'" . ($row['status'] == 'Pesanan Diterima Pemesan' ? ' selected' : '') . ">Pesanan Diterima Pemesan</option>
                                                <option value='Harap Kirim Ulang Bukti Bayar'" . ($row['status'] == 'Harap Kirim Ulang Bukti Bayar' ? ' selected' : '') . ">Harap Kirim Ulang Bukti Bayar</option>
                                                <option value='Pesanan Ditolak, Alamat di luar Wilayah'" . ($row['status'] == 'Pesanan Ditolak, Alamat di luar Wilayah' ? ' selected' : '') . ">Ditolak, Luar Wilayah</option>
                                                <option value='Pesanan Ditolak, Alamat di luar Wilayah & Dana Dikembalikan'" . ($row['status'] == 'Pesanan Ditolak, Alamat di luar Wilayah & Dana Dikembalikan' ? ' selected' : '') . ">Ditolak, Dana Kembali</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class='align-middle'>
                                        <button class='btn btn-primary text-white' data-bs-toggle='modal' data-bs-target='#" . $detail_id . "'>Detail</button>
                                        <div class='modal fade' id='" . $detail_id . "' tabindex='-1' aria-labelledby='" . $detail_id . "Label' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='" . $detail_id . "Label'>Detail Order ID: " . $row["id"] . "</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <div style='text-align: left;'><strong>No:</strong> " . $no . "</div>
                                                        <div style='text-align: left;'><strong>Nama:</strong> " . $row["nama"] . "</div>
                                                        <div style='text-align: left;'><strong>Telepon:</strong> " . $row["telepon"] . "</div>
                                                        <div style='text-align: left;'><strong>Email:</strong> " . $row["email"] . "</div>
                                                        <div style='text-align: left;'><strong>Wilayah:</strong> " . $row["wilayah"] . "</div>
                                                        <div style='text-align: left;'><strong>Alamat:</strong> " . $row["alamat"] . "</div>
                                                        <div style='text-align: left;'><strong>Variant:</strong> " . $row["variant"] . "</div>
                                                        <div style='text-align: left;'><strong>Variant ID:</strong> " . $row["product_id"] . "</div>
                                                        <div style='text-align: left;'><strong>Quantity:</strong> " . $row["quantity"] . "</div>
                                                        <div style='text-align: left;'><strong>Harga:</strong> " . $row["harga_orders"] . "</div>
                                                        <div style='text-align: left;'><strong>Metode Pembayaran:</strong> " . $row["mtdBayar"] . "</div>
                                                        <div style='text-align: left;'><strong>Waktu Order:</strong> " . $row["order_date"] . "</div>
                                                        <div style='text-align: left;'><strong>Status:</strong> " . $row["status"] . "</div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class='align-middle'>
                                        <a href='orders-delete.php?delete_id=" . $row['id'] . "' onclick='return confirmDelete()' class='btn btn-danger text-white'>Hapus</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>Tidak ada hasil pencarian untuk '" . htmlspecialchars($keyword, ENT_QUOTES) . "'</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Silakan masukkan kata kunci pencarian.</td></tr>";
                }
                ?>
            </table>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();

        function confirmStatusUpdate(selectElement) {
            if (confirm('Yakin ingin mengubah status order?')) {
                selectElement.form.submit();
            } else {
                // Jika pembatalan, kembalikan ke status sebelumnya
                selectElement.value = selectElement.getAttribute('data-previous-value');
            }
        }

        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');
        }
    </script>
</body>

</html>