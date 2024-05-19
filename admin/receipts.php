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
                    <td><?= $row->bktBayar ?></td>
                    <td class="d-flex justify-content-center gap-2">
                        <a class="btn btn-danger" href="aksi-proses.php?aksi=delete&id=<?= $row->id ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php
    }
    ?>
</div>