<?php include '../connection.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="./images/logo.png" type="image/x-icon">
    <title>Dapur Sehat</title>
</head>

<body>
    <!-- hero-container -->
    <section id="hero-container" style="
    background-image: url('images/bgtop.svg');
    background-size: cover; 
    background-repeat: no-repeat; 
    background-position: center;
    ">
        <!-- Navbar -->
        <div id="navbar"></div>
    </section>

    <!-- tabelCariPesanan -->
    <section id="tabelCariPesanan">
        <div class="container py-2">
            <h1 class="title py-2">Berikut Data Pemesanan Anda</h1>
            <div class="container py-4 table-responsive">
                <main>
                    <table class="table table-hover text-center" data-aos="fade-down">
                        <tr class="table-dark">
                            <th>Id Pesanan</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Variant</th>
                            <th>Quantity</th>
                            <th>Harga</th>
                            <th>Metode Pembayaran</th>
                            <th>Waktu Order</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Print</th>
                        </tr>
                        <?php
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
                                        o.telepon  = '$keyword'
                                    GROUP BY
                                        o.id, o.nama, o.telepon, o.email, o.wilayah, o.alamat, o.mtdBayar, o.order_date, o.status";
                            $result = mysqli_query($db, $query);

                            if ($result) {
                                // Cek jumlah baris hasil pencarian
                                $num_rows = mysqli_num_rows($result);

                                if ($num_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $detail_id = "detail_" . $row["id"];
                                        $status_class = "";

                                        switch ($row["status"]) {
                                            case 'Menunggu Bukti Pembayaran':
                                                $status_class = "style='color: #6C757D; font-weight: bold;'";
                                                break;
                                            case 'Bukti Bayar Terkonfirmasi':
                                                $status_class = "style='color: #198754; font-weight: bold;'";
                                                break;
                                            case 'Harap Kirim Ulang Bukti Bayar':
                                                $status_class = "style='color: #DC3545; font-weight: bold;'";
                                                break;
                                            case 'Pesanan Diproses':
                                                $status_class = "style='color: #FF9843; font-weight: bold;'";
                                                break;
                                            case 'Pesanan Diantar':
                                                $status_class = "style='color: #0DCAF0; font-weight: bold;'";
                                                break;
                                            case 'Pesanan Diterima Pemesan':
                                                $status_class = "style='color: #38419D; font-weight: bold;'";
                                                break;
                                            case 'Harap Kirim Ulang Bukti Bayar':
                                                $status_class = "style='color: #DC3545; font-weight: bold;'";
                                                break;
                                            case 'Pesanan Ditolak, Alamat di luar Wilayah':
                                                $status_class = "style='color: #DC3545; font-weight: bold;'";
                                                break;
                                            case 'Pesanan Ditolak, Alamat di luar Wilayah & Dana Dikembalikan':
                                                $status_class = "style='color: #DC3545; font-weight: bold;'";
                                                break;
                                            default:
                                                $status_class = "";
                                                break;
                                        }

                                        echo "<tr>
                                                <td class='align-middle'>" . $row["id"] . "</td>
                                                <td class='align-middle'>" . $row["nama"] . "</td>
                                                <td class='align-middle'>" . $row["telepon"] . "</td>
                                                <td class='align-middle'>" . $row["variant"] . "</td>
                                                <td class='align-middle'>" . $row["quantity"] . "</td>
                                                <td class='align-middle'>" . $row["harga_orders"] . "</td>
                                                <td class='align-middle'>" . $row["mtdBayar"] . "</td>
                                                <td class='align-middle'>" . $row["order_date"] . "</td>
                                                <td class='align-middle' {$status_class}>" . $row["status"] . "</td>
                                                <td class='align-middle'>
                                                    <button class='btn btn-primary text-white' data-bs-toggle='modal' data-bs-target='#" . $detail_id . "'>Detail</button>
                                                </td>
                                                <td class='align-middle'>
                                                    <a class='btn text-white' href='../print-order.php?order_id=" .  $row["id"] . "' style='background-color: purple';>Print</a>
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
                                } else {
                                    echo "<tr><td colspan='11'>Tidak ada hasil pencarian untuk '" . htmlspecialchars($keyword, ENT_QUOTES) . "'</td></tr>";
                                }
                            } else {
                                echo '<tr><td colspan="11">Terjadi kesalahan dalam mengambil data.</td></tr>';
                            }
                        } else {
                            echo '<tr><td colspan="11">Tidak ada data.</td></tr>';
                        }
                        ?>
                    </table>
                </main>
            </div>
        </div>
    </section>

    <!-- footer -->
    <section id="footer" style="background-color: #3468C0;">
    </section>

    <!-- buttonScrollUp -->
    <div class="container">
        <button id="scrollUpBtn" class="btn d-none float-end">
            <img style="width: 50px; height: 50px;" src="images/arrow.svg">
        </button>
    </div>

    <!-- Import Bootsrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- DOM Navbar dan Footer -->
    <script src="scripts/App.js"></script>

    <!-- Import AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
        });
    </script>

    <!-- Scroll Up -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk menangani perilaku tombol "Scroll Up"
            document.getElementById('scrollUpBtn').addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Fungsi untuk memeriksa posisi scroll
            window.addEventListener('scroll', function() {
                var scrollPosition = window.scrollY;

                if (scrollPosition > 300) {
                    document.getElementById('scrollUpBtn').classList.remove('d-none');
                } else {
                    document.getElementById('scrollUpBtn').classList.add('d-none');
                }
            });
        });
    </script>
</body>

</html>