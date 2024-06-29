<?php
include '../connection.php';

// Query untuk menghitung total harga_orders dengan status tertentu
$query = "SELECT SUM(oi.harga_orders) AS total_pemasukkan
            FROM orders o
            JOIN order_items oi ON o.id = oi.order_id
            WHERE o.status IN ('Bukti Bayar Terkonfirmasi', 'Pesanan Diproses', 'Pesanan Diantar', 'Pesanan Diterima Pemesan')";

$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$total_pemasukkan = $row['total_pemasukkan'];

// Query untuk menghitung total modal usaha dari tabel products
$query_stock = "SELECT id, variant, stock, harga, stock * (harga - 5000) AS modal_per_product FROM products";
$result_stock = mysqli_query($db, $query_stock);
$modal_items = [];
$total_modal_usaha = 0;
while ($row_stock = mysqli_fetch_assoc($result_stock)) {
    $modal_items[] = $row_stock;
    $total_modal_usaha += $row_stock['modal_per_product'];
}

// Hitung pemasukkan bersih
$pemasukkan_bersih = $total_pemasukkan - $total_modal_usaha;

// Hitung jumlah pemesan dengan status tertentu
$query_count = "SELECT COUNT(*) AS total_pemesan
                FROM orders
                WHERE status IN ('Bukti Bayar Terkonfirmasi', 'Pesanan Diproses', 'Pesanan Diantar', 'Pesanan Diterima Pemesan')";

$result_count = mysqli_query($db, $query_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_pemesan = $row_count['total_pemesan'];
?>

<div data-aos="zoom-in-up" data-aos-duration="1000" class="container my-5" width="900" height="380">
    <div class="p-5 text-center rounded-3" style="background-color: #38419D;">
        <h1 class="text-white">Selamat Datang di Dashboard Admin<br>Dapur Sehat</h1>
        <p class="lead" style="color: #DADDFC;">Lakukan Manajemen Pekerjaan dengan Bijak dan Tanggung Jawab</p>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 my-3">
        <!-- Card 1 -->
        <div class="col">
            <div class="card h-100 w-100">
                <div class="card-body rounded-3" style="background-color: #D1E4FF; border: 2px solid #38419D">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0">Pendapatan Kotor</h5>
                        <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="*Pendapatan berdasarkan nominal dana yang diterima setelah status bukti bayar terkonfirmasi">
                            <img src='../public/images/question.svg' width='20px' alt='question'>
                        </button>
                    </div>
                    <h6 class="card-subtitle mb-2 text-body-secondary" style="font-size: 30px;">Rp <?php echo number_format($total_pemasukkan, 0, ',', '.'); ?></h6>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col">
            <div class="card h-100 w-100">
                <div class="card-body rounded-3" style="background-color: #D1E4FF; border: 2px solid #38419D">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0">Pendapatan Bersih</h5>
                        <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="*Pendapatan berdasarkan nominal dana yang diterima setelah status bukti bayar terkonfirmasi dan kalkulasi modal usaha">
                            <img src='../public/images/question.svg' width='20px' alt='question'>
                        </button>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="card-subtitle mb-2 text-body-secondary" style="font-size: 30px;">Rp <?php echo number_format($pemasukkan_bersih, 0, ',', '.'); ?></h6>
                        <button type="button" class="btn btn-pendapatan" data-bs-toggle="modal" data-bs-target="#rincianModal">Rincian</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col">
            <div class="card h-100 w-100">
                <div class="card-body rounded-3" style="background-color: #D1E4FF; border: 2px solid #38419D">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0">Pemesan dengan Dana Masuk</h5>
                        <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-title="*Total Pemesan yang saat ini status pemesanannya 'Bukti Bayar Terkonfirmasi', 'Pesanan Diproses', 'Pesanan Diantar', ataupun 'Pesanan Diterima Pemesan'">
                            <img src='../public/images/question.svg' width='20px' alt='question'>
                        </button>
                    </div>
                    <h6 class="card-subtitle mb-2 text-body-secondary" style="font-size: 30px;"><?php echo $total_pemesan; ?> Pemesan</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="rincianModal" tabindex="-1" aria-labelledby="rincianModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rincianModalLabel">Rincian Modal Usaha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Produk</th>
                            <th>Varian Produk</th>
                            <th>Stock</th>
                            <th>Harga per Quantity</th>
                            <th>Modal per Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($modal_items as $item) { ?>
                            <tr>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo $item['variant']; ?></td>
                                <td><?php echo $item['stock']; ?></td>
                                <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                                <td>Rp <?php echo number_format($item['modal_per_product'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">Total Modal Usaha</th>
                            <th>Rp <?php echo number_format($total_modal_usaha, 0, ',', '.'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>