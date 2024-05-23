<div id="products" class="container py-4 table-responsive">
    <h3 class="text-center fw-bold">DAFTAR PRODUK</h3>
    <div class="mb-3 d-flex align-content-center align-items-center">
        <a class="btn btn-success">Tambah Produk</a>
        <form class="ms-auto" role="search">
            <div class="search">
                <input id="searchInput" type="text" class="form-control" placeholder="Search..." aria-label="Search">
                <button id="searchButton" type="submit"><img src="../public/images/search.svg" width="20px"
                        alt="search"></button>
            </div>
        </form>
    </div>
    <table class=" table table-hover text-center" data-aos="fade-down">
        <tr class="table-dark">
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
        <tr>
            <td>id</td>
            <td>variant</td>
            <td>photo1</td>
            <td>photo2</td>
            <td>photo3</td>
            <td>harga</td>
            <td>isi</td>
            <td>deskripsi</td>
            <td>stock</td>
            <td class="d-flex justify-content-center gap-2">
                <a class="btn btn-warning">Update</a>
                <a class="btn btn-danger">Delete</a>
            </td>
        </tr>
    </table>
</div>