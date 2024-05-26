<?php include '../connection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="css/style.css">
    <title>Dapur Sehat</title>
</head>

<body>
    <section id="hero-container" style="
        background-image: url('images/bgtop.svg');
        background-size: cover; 
        background-repeat: no-repeat; 
        background-position: center;
        ">
        <!-- Navbar -->
        <div id="navbar"></div>
    </section>

    <!-- form pemesanan -->
    <section id="formPemesanan">
        <div class="container py-4">
            <form action="../admin/insert-order.php" method="POST">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <h2>Data Diri</h2>
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama:</label>
                            <input class="form-control" placeholder="Masukkan Nama Anda" type="text" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="telepon">Telepon:</label>
                            <input class="form-control" placeholder="Contoh: 628xxxxxxx" type="text" id="telepon" name="telepon" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email:</label>
                            <input class="form-control" placeholder="Isi Jika Memiliki EMail" type="email" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="wilayah">Pilih Wilayah:</label>
                            <select name="wilayah" class="form-select" required>
                                <option value="" selected disabled>Pilih Wilayah Terdekat Pemesan</option>
                                <option value="Cisauk">Cisauk</option>
                                <option value="Tangerang Selatan">Tangerang Selatan</option>
                                <option value="Kampus K Universitas Gunadarma">Kampus K Universitas Gunadarma</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="alamat">Alamat Lengkap:</label>
                            <input class="form-control" placeholder="Ingin Diantar Kemana?" type="text" id="alamat" name="alamat" required>
                        </div>
                        <h2>Produk</h2>
                        <?php
                        // Ambil data produk dari database
                        $sql = "SELECT id, variant, stock FROM products";
                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            foreach ($result as $row) {
                                echo "<div class='form-check'>";
                                echo "<input class='form-check-input' type='checkbox' id='product_" . $row["id"] . "' name='product_id[" . $row["id"] . "]' value='" . $row["id"] . "' data-stock='" . $row["stock"] . "'>
                                        <label class='form-check-label' for='product_" . $row["id"] . "'>" . $row["variant"] . " (Stok: " . $row["stock"] . ")</label>";
                                echo "</div>";
                                echo "<input class='form-control' placeholder='Ingin Berapa Kotak?'  type='number' id='quantity_" . $row["id"] . "' name='quantity[" . $row["id"] . "]' min='1'><br>";
                            }
                        } else {
                            echo "<p>Tidak ada produk tersedia</p>";
                        }
                        ?>
                        <h2>Metode Pembayaran</h2>
                        <label class="form-label" for="mtdBayar">Pilih Metode Pembayaran</label>
                        <select class="form-select" id="mtdBayar" name="mtdBayar" required>
                            <option value="" selected disabled>Pilih Metode Pembayaran</option>
                            <option value="OVO">OVO</option>
                            <option value="GOPAY">GOPAY</option>
                        </select>
                        
                        <button type="submit" class="btn custom-button-submit mt-4">ORDER</button>
                    </div>
                </div>
            </form>
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