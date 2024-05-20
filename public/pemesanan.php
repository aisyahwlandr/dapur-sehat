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
            <form id="orderForm">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <h2>Data Diri</h2>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="telepon" class="form-control" placeholder="Contoh: 628xxxxxxx" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">EMail (Optional)</label>
                            <input type="email" name="email" class="form-control" placeholder="Isi Jika Memiliki EMail">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih Wilayah</label>
                            <select name="wilayah" class="form-select" required>
                                <option value="" selected disabled>Pilih Wilayah Terdekat Pemesan</option>
                                <option value="Cisauk">Cisauk</option>
                                <option value="Tangerang Selatan">Tangerang Selatan</option>
                                <option value="Kampus K Universitas Gunadarma">Kampus K Universitas Gunadarma</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Ingin Diantar Kemana?" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 pt-md-0 pt-3">
                        <h2>Produk</h2>
                        <div id="productList">
                            <div class="mb-3">
                                <label class="form-label">Nugget Ayam Original (Rp 30.000)</label>
                                <input type="number" min="0" name="produk[Nugget Ayam Original]" class="form-control" placeholder="Jumlah" onchange="updateTotal()">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nugget Ayam Keju (Rp 35.000)</label>
                                <input type="number" min="0" name="produk[Nugget Ayam Keju]" class="form-control" placeholder="Jumlah" onchange="updateTotal()">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nugget Pisang (Rp 20.000)</label>
                                <input type="number" min="0" name="produk[Nugget Pisang]" class="form-control" placeholder="Jumlah" onchange="updateTotal()">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bakso Sapi (Rp 25.000)</label>
                                <input type="number" min="0" name="produk[Bakso Sapi]" class="form-control" placeholder="Jumlah" onchange="updateTotal()">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kentang Goreng (Rp 35.000)</label>
                                <input type="number" min="0" name="produk[Kentang Goreng]" class="form-control" placeholder="Jumlah" onchange="updateTotal()">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12 pt-md-5 pt-3">
                            <h2>Metode Pembayaran</h2>
                            <div class="mb-3">
                                <select name="metopembayaran" class="form-select" required>
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
                                    <h4 id="totalPembayaran">Rp 0,-</h4>
                                </div>
                                <div class="mb-3 ms-auto">
                                    <button type="button" class="btn custom-button-submit" onclick="showPopup()">ORDER</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Order Summary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="orderSummary"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetForm()">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
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
        document.addEventListener('DOMContentLoaded', function () {
            // Fungsi untuk menangani perilaku tombol "Scroll Up"
            document.getElementById('scrollUpBtn').addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Fungsi untuk memeriksa posisi scroll
            window.addEventListener('scroll', function () {
                var scrollPosition = window.scrollY;

                if (scrollPosition > 300) {
                    document.getElementById('scrollUpBtn').classList.remove('d-none');
                } else {
                    document.getElementById('scrollUpBtn').classList.add('d-none');
                }
            });
        });
    </script>

    <!-- price and popup -->
    <script>
        // price for products
        const productPrices = {
            'Nugget Ayam Original': 30000,
            'Nugget Ayam Keju': 35000,
            'Nugget Pisang': 20000,
            'Bakso Sapi': 25000,
            'Kentang Goreng': 35000
        };

        function updateTotal() {
            let total = 0;

            document.querySelectorAll('#productList input[type="number"]').forEach(input => {
                let jumlah = parseInt(input.value);
                if (jumlah > 0) {
                    let productName = input.name.replace("produk[", "").replace("]", "");
                    total += jumlah * productPrices[productName];
                }
            });

            document.getElementById('totalPembayaran').innerText = 'Rp ' + total.toLocaleString('id-ID') + ',-';
        }

        // popup
        function showPopup() {
            const form = document.forms['orderForm'];
            let message = "";

            // Check each field and accumulate error messages for empty fields
            if (!form['nama'].value) {
                message += "Nama belum terisi.\n";
            }
            if (!form['telepon'].value) {
                message += "Telepon belum terisi.\n";
            }
            if (!form['wilayah'].value) {
                message += "Wilayah belum terisi.\n";
            }
            if (!form['alamat'].value) {
                message += "Alamat belum terisi.\n";
            }

            let selectedProducts = [];
            let totalJumlahProduk = 0;
            let totalHarga = 0;

            document.querySelectorAll('#productList input[type="number"]').forEach(input => {
                let jumlah = parseInt(input.value);
                if (jumlah > 0) {
                    let productName = input.name.replace("produk[", "").replace("]", "");
                    selectedProducts.push({
                        produk: productName,
                        jumlah: jumlah
                    });
                    totalJumlahProduk += jumlah;
                    totalHarga += jumlah * productPrices[productName];
                }
            });

            if (selectedProducts.length === 0) {
                message += "Tidak ada produk yang dipilih.\n";
            }

            if (!form['metopembayaran'].value) {
                message += "Metode Pembayaran belum terisi.\n";
            }

            if (message) {
                alert(message);
                return;
            }

            const nama = form['nama'].value;
            const telepon = form['telepon'].value;
            const email = form['email'].value;
            const wilayah = form['wilayah'].value;
            const alamat = form['alamat'].value;
            const metopembayaran = form['metopembayaran'].value;

            let summaryText = `
                <strong>Nama:</strong> ${nama}<br>
                <strong>Telepon:</strong> ${telepon}<br>
                <strong>Email:</strong> ${email ? email : 'Tidak ada'}<br>
                <strong>Wilayah:</strong> ${wilayah}<br>
                <strong>Alamat:</strong> ${alamat}<br>
                <strong>Metode Pembayaran:</strong> ${metopembayaran}<br>
                <strong>Produk:</strong><br>
            `;

            selectedProducts.forEach(product => {
                summaryText += `${product.produk}: ${product.jumlah} x Rp ${productPrices[product.produk].toLocaleString('id-ID')}<br>`;
            });

            summaryText += `<strong>Total Pembayaran:</strong> Rp ${totalHarga.toLocaleString('id-ID')},-`;

            document.getElementById('orderSummary').innerHTML = summaryText;

            const modal = new bootstrap.Modal(document.getElementById('orderModal'));
            modal.show();
        }

        function resetForm() {
            document.getElementById('orderForm').reset();
            updateTotal();
        }

        function submitForm() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
            modal.hide();

            // add actual form submission logic, like an AJAX request to server
            window.location.href = "pembayaran.php";
        }
    </script>

</body>

</html>