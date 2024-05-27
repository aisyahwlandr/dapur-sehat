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
            <form action="../admin/insert-order.php" method="POST" id="orderForm">
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
                    </div>
                    <div class="col-md-6 col-12 pt-md-0 pt-3">
                        <h2>Produk</h2>
                        <?php
                        // Ambil data produk dari database
                        $sql = "SELECT id, variant, stock, harga FROM products";
                        $result = $db->query($sql);

                        if ($result->num_rows > 0) {
                            foreach ($result as $row) {
                                echo "<div class='form-check'>";
                                echo "<input class='form-check-input' type='checkbox' id='product_" . $row["id"] . "' name='product_id[" . $row["id"] . "]' value='" . $row["id"] . "' data-harga='" . $row["harga"] . "' data-stock='" . $row["stock"] . "'>
                                        <label class='form-check-label' for='product_" . $row["id"] . "'>" . $row["variant"] . " (Stok: " . $row["stock"] . ", Harga: Rp" . number_format($row["harga"], 0, ',', '.') . ",-)</label>";
                                echo "</div>";
                                echo "<input class='form-control' placeholder='Ingin Berapa Kotak?' type='number' id='quantity_" . $row["id"] . "' name='quantity[" . $row["id"] . "]' min='1' data-harga='" . $row["harga"] . "'><br>";
                            }
                        } else {
                            echo "<p>Tidak ada produk tersedia</p>";
                        }

                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 pt-md-5 pt-3">
                        <div class="mb-3">
                            <label class="form-label h2" for="mtdBayar">Metode Pembayaran</label>
                            <select class="form-select" id="mtdBayar" name="mtdBayar" required>
                                <option value="" selected disabled>Pilih Metode Pembayaran</option>
                                <option value="OVO">OVO</option>
                                <option value="GOPAY">GOPAY</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 pt-md-5 pt-3">
                        <h2>Total Pembayaran</h2>
                        <div class="d-flex">
                            <div class="mb-3">
                                <h4 id="totalHarga">Rp 0,-</h4>
                            </div>
                            <div class="mb-3 ms-auto">
                                <button type="button" class="btn custom-button-submit" id="nextButton">NEXT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="summaryModal" tabindex="-1" aria-labelledby="summaryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="summaryModalLabel">Order Summary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="summaryDataDiri"></p>
                    <h6>Produk</h6>
                    <ul id="summaryProducts"></ul>
                    <h6>Metode Pembayaran</h6>
                    <p id="summaryMtdBayar"></p>
                    <h6>Total Pembayaran</h6>
                    <p id="summaryTotalHarga"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelButton">CANCEL</button>
                    <button type="button" class="btn btn-primary" id="payButton">PESAN</button>
                </div>
            </div>
        </div>
    </div>


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

    <!-- Calculate Total Price -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const quantities = document.querySelectorAll('input[type="number"]');
            const totalHargaEl = document.getElementById('totalHarga');

            function formatRupiah(amount) {
                return 'Rp ' + amount.toLocaleString('id-ID') + ',-';
            }

            function updateTotalPrice() {
                let total = 0;
                checkboxes.forEach((checkbox, index) => {
                    const quantity = parseFloat(quantities[index].value) || 0;
                    if (quantity > 0) {
                        checkbox.checked = true;
                    } else {
                        checkbox.checked = false;
                    }

                    if (checkbox.checked) {
                        const price = parseFloat(checkbox.getAttribute('data-harga'));
                        total += price * quantity;
                    }
                });
                totalHargaEl.textContent = formatRupiah(total);
            }

            checkboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', updateTotalPrice);
            });

            quantities.forEach(quantity => {
                quantity.addEventListener('input', updateTotalPrice);
            });
        });
    </script>

    <!-- Summary Modal Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nextButton = document.getElementById('nextButton');
            const orderForm = document.getElementById('orderForm');
            const summaryModal = new bootstrap.Modal(document.getElementById('summaryModal'), {});
            const summaryDataDiri = document.getElementById('summaryDataDiri');
            const summaryProducts = document.getElementById('summaryProducts');
            const summaryTotalHarga = document.getElementById('summaryTotalHarga');
            const summaryMtdBayar = document.getElementById('summaryMtdBayar');
            const cancelButton = document.getElementById('cancelButton');
            const payButton = document.getElementById('payButton');

            nextButton.addEventListener('click', function() {
                const formData = new FormData(orderForm);

                summaryDataDiri.innerHTML = `
        <strong>Nama:</strong> ${formData.get('nama')}<br>
        <strong>Telepon:</strong> ${formData.get('telepon')}<br>
        <strong>Email:</strong> ${formData.get('email')}<br>
        <strong>Wilayah:</strong> ${formData.get('wilayah')}<br>
        <strong>Alamat:</strong> ${formData.get('alamat')}
    `;

                summaryProducts.innerHTML = '';
                let total = 0;
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                const quantities = document.querySelectorAll('input[type="number"]');
                checkboxes.forEach((checkbox, index) => {
                    if (checkbox.checked) {
                        const productName = checkbox.nextElementSibling.textContent.split('(')[0].trim();
                        const quantity = formData.get(`quantity[${checkbox.value}]`);
                        const price = parseFloat(checkbox.getAttribute('data-harga'));
                        const subtotal = price * quantity; // Hitung subtotal harga per pesanan
                        total += subtotal;

                        const productItem = document.createElement('li');
                        productItem.innerHTML = `${productName} - ${quantity} <br>Subtotal: Rp ${formatRupiah(subtotal)}`; // Tampilkan harga per pesanan
                        summaryProducts.appendChild(productItem);
                    }
                });
                summaryMtdBayar.textContent = formData.get('mtdBayar');
                summaryTotalHarga.textContent = formatRupiah(total);

                summaryModal.show();
            });

            cancelButton.addEventListener('click', function() {
                orderForm.reset();
                document.getElementById('totalHarga').textContent = 'Rp 0,-';
                summaryModal.hide();
            });

            payButton.addEventListener('click', function() {
                orderForm.submit();
            });
        });

        function formatRupiah(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID') + ',-';
        }
    </script>

</body>

</html>