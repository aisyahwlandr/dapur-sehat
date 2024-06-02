<?php include '../connection.php'; ?>

<div id="products" class="container py-4 table-responsive">
    <h3 class="text-center fw-bold">DAFTAR PRODUK</h3>
    <div class="mb-3 d-flex align-content-center align-items-center">
        <a class="btn btn-success" href="product-form.php?id=<?php echo $id; ?>">Tambah Produk</a>
        <?php
        $result = mysqli_query($db, "SELECT * FROM admin WHERE id='$_GET[id]'");
        $row = mysqli_fetch_object($result);
        ?>
        <form class="ms-auto" role="search" action="search-products.php" method="get">
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
    </div>
    <table class=" table table-hover text-center" data-aos="fade-down">
        <tr class="table-dark">
            <th>No</th>
            <th>Id</th>
            <th>Variant</th>
            <th>Photo 1</th>
            <th>Photo 2</th>
            <th>Photo 3</th>
            <th>Harga</th>
            <th>Isi</th>
            <th>Deskripsi</th>
            <th>Stock</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 0;
        $result = mysqli_query($db, "SELECT * FROM products");

        while ($row = mysqli_fetch_object($result)) {
            $no++;
        ?>
            <tr>
                <td class='align-middle'><?= $no ?></td>
                <td class='align-middle'><?= $row->id ?></td>
                <td class='align-middle'><?= $row->variant ?></td>
                <td class='align-middle'><button class="btn btn-primary" onclick="showProduct('<?= $row->photo1 ?>')">Lihat</button></td>
                <td class='align-middle'><button class="btn btn-primary" onclick="showProduct('<?= $row->photo2 ?>')">Lihat</button></td>
                <td class='align-middle'><button class="btn btn-primary" onclick="showProduct('<?= $row->photo3 ?>')">Lihat</button></td>
                <td class='align-middle'><?= $row->harga ?></td>
                <td class='align-middle'><?= $row->isi ?></td>
                <td class='align-middle'><?= $row->deskripsi ?></td>
                <td class='align-middle'><?= $row->stock ?></td>
                <td class='align-middle'>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-warning me-1" href="product-form.php?id=<?php echo $id; ?>&update_id=<?= $row->id ?>">Update</a>
                        <a class="btn btn-danger" href="product-delete.php?delete_id=<?= $row->id ?>" onclick='return confirmDelete()'>Delete</a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="receiptImage" src="" alt="Photo" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    function showProduct(imageSrc) {
        // Menambahkan path yang diinginkan sebelum nama file gambar
        var imagePath = "./uploads/products/" + imageSrc;
        document.getElementById('receiptImage').src = imagePath;
        var myModal = new bootstrap.Modal(document.getElementById('productModal'), {
            keyboard: false
        });
        myModal.show();
    }
</script>

<script>
    function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus produk ini?');
        }
</script>