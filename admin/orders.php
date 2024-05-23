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
            <th>Variant</th>
            <th>Quantity</th>
            <th>Harga</th>
            <th>Metode Pembayaran</th>
            <th>Waktu Order</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <tr>
            <td>id</td>
            <td>nama</td>
            <td>telepon</td>
            <td>email</td>
            <td>wilayah</td>
            <td>alamat</td>
            <td>variant_orders</td>
            <td>quantity</td>
            <td>harga</td>
            <td>mtdBayar</td>
            <td>order_date</td>
            <td>status</td>
            <td class="d-flex justify-content-center gap-2">
                <a class="btn btn-danger">Delete</a>
            </td>
        </tr>
    </table>
</div>