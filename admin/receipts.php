<?php include '../connection.php'; ?>

<div id="receipts" class="container py-4 table-responsive">
    <h3 class="text-center fw-bold">DAFTAR BUKTI PEMBAYARAN</h3>
    <?php
    $result = mysqli_query($db, "SELECT * FROM admin WHERE id='$_GET[id]'");
    $row = mysqli_fetch_object($result);
    ?>
    <form class="mb-3 float-end" role="search" action="search-receipts.php" method="get">
        <div class="search">
            <?php $tcari = isset($_GET['tcari']) ? $_GET['tcari'] : ''; ?>
            <input id="searchInput" type="text" name="tcari" value="<?= $tcari ?>" class="form-control" placeholder="Search..." aria-label="Search">
            <!-- Menambahkan input tersembunyi untuk menyertakan ID -->
            <input type="hidden" name="id" value="<?= $row->id ?>">
            <button id="searchButton" type="submit">
                <img src="../public/images/search.svg" width="20px" alt="search">
            </button>
        </div>
    </form>

    <?php if (!isset($_GET['view'])) { ?>
        <table class=" table table-hover text-center" data-aos="fade-down">
            <tr class="table-dark">
                <th>No</th>
                <th>Id</th>
                <th>No. Telepon</th>
                <th>Created At</th>
                <th>Bukti Pembayaran</th>
                <!-- <th>Aksi</th> -->
            </tr>
            <?php
            $no = 0;
            $result = mysqli_query($db, "SELECT * FROM receipts");

            while ($row = mysqli_fetch_object($result)) {
                $no++;
            ?>
                <tr>
                    <td class="align-middle"><?= $no ?></td>
                    <td class="align-middle"><?= $row->id ?></td>
                    <td class="align-middle"><?= $row->telepon ?></td>
                    <td class="align-middle"><?= $row->createdAt ?></td>
                    <td class="align-middle">
                        <button class="btn btn-primary" onclick="showReceipt('<?= $row->bktBayar ?>')">Lihat</button>
                    </td>
                    <!-- <td class="align-middle">
                        <a class="btn btn-danger" href="receipts-delete.php?delete_id=<?= $row->id ?>" onclick="return confirmDelete()">Delete</a>
                    </td> -->
                </tr>
            <?php } ?>
        </table>
    <?php
    }
    ?>
</div>

<!-- Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="receiptImage" src="" alt="Bukti Pembayaran" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    function showReceipt(imageSrc) {
        // Menambahkan path yang diinginkan sebelum nama file gambar
        var imagePath = "./uploads/receipts/" + imageSrc;
        document.getElementById('receiptImage').src = imagePath;
        var myModal = new bootstrap.Modal(document.getElementById('receiptModal'), {
            keyboard: false
        });
        myModal.show();
    }
</script>
<!-- 
<script>
    function confirmDelete() {
        return confirm('Apakah Anda yakin ingin menghapus Bukti Pembayaran ini?');
    }
</script> -->