<div id="receipts" class="container py-4 table-responsive">
    <h3 class="text-center fw-bold">DAFTAR BUKTI PEMBAYARAN</h3>
    <form class="mb-3 float-end" role="search">
        <div class="search">
            <input id="searchInput" type="text" class="form-control" placeholder="Search..." aria-label="Search">
            <button id="searchButton" type="submit"><img src="../public/images/search.svg" width="20px" alt="search"></button>
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
                <th>Aksi</th>
            </tr>
            <?php
            $no = 0;
            $result = mysqli_query($db, "SELECT * FROM receipts");

            while ($row = mysqli_fetch_object($result)) {
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->id ?></td>
                    <td><?= $row->telepon ?></td>
                    <td><?= $row->createdAt ?></td>
                    <td> 
                        <button class="btn btn-primary" onclick="showReceipt('<?= $row->bktBayar ?>')">Lihat</button>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="aksi-proses.php?aksi=delete&id=<?= $row->id ?>">Delete</a>
                    </td>
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
        var imagePath = "/dapursehat/admin/uploads/receipts/" + imageSrc;
        document.getElementById('receiptImage').src = imagePath;
        var myModal = new bootstrap.Modal(document.getElementById('receiptModal'), {
            keyboard: false
        });
        myModal.show();
    }
</script>