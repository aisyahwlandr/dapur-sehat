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
        <?php
        include '../connection.php';

        //query untuk menampilkan data
        $query = "SELECT * FROM orders";
        $result = mysqli_query($db, $query);

        //loop untuk menampilkan data
        while ($row = mysqli_fetch_object($result)) {
            echo "<tr>";
            echo "<td>" . $row->id . "</td>";
            echo "<td>" . $row->nama . "</td>";
            echo "<td>" . $row->telepon . "</td>";
            echo "<td>" . $row->email . "</td>";
            echo "<td>" . $row->wilayah . "</td>";
            echo "<td>" . $row->alamat . "</td>";
            echo "<td>" . $row->variant_orders . "</td>";
            echo "<td>" . $row->quantity . "</td>";
            echo "<td>" . $row->harga_orders . "</td>";
            echo "<td>" . $row->mtdBayar . "</td>";
            echo "<td>" . $row->order_date . "</td>";
            echo "<td>" . $row->status . "</td>";
            echo "<td class='d-flex justify-content-center gap-2'>";
            echo "<a class='btn btn-danger' href='delete_order.php?id=" . $row->id . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }

        //tutup koneksi database
        mysqli_close($db);
        ?>
    </table>
</div>
