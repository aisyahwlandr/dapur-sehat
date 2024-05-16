<div id="orders" class="container py-4 table-responsive">
    <h3 class="text-center fw-bold">DAFTAR PEMESANAN</h3>
    <form class="mb-3 float-end" role="search">
        <div class="search">
            <input id="searchInput" type="text" class="form-control" placeholder="Search..." aria-label="Search">
            <button id="searchButton" type="submit"><img src="../public/images/search.svg" width="20px"
                    alt="search"></button>
        </div>
    </form>
    <table class=" table table-hover text-center" data-aos="fade-down">
        <tr class="table-dark">
            <th>Id</th>
            <th>Nama</th>
            <th>No. Telepon</th>
            <th>Email</th>
            <th>Wilayah</th>
            <th>Alamat</th>
            <th>Jml Produk</th>
            <th>Variant</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <tr>
            <td>id</td>
            <td>nama</td>
            <td>telepon</td>
            <td>email</td>
            <td>wilayah</td>
            <td>Alamat</td>
            <td>jmlproduk</td>
            <td>variant</td>
            <td>status</td>
            <td class="d-flex justify-content-center gap-2">
                <a class="btn btn-warning" href="?page=products&view=update&id=<?= $row->id ?>">Update</a>
                <a class="btn btn-danger" href="products-proses.php?aksi=delete&id=<?= $row->id ?>">Delete</a>
            </td>
        </tr>
    </table>
</div>