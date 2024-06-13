<?php include '../connection.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="./images/logo.png" type="image/x-icon">
    <title>Dapur Sehat</title>
</head>

<body>
    <!-- hero-container -->
    <section id="hero-container" style="
    background-image: url('images/bgtop.svg');
    background-size: cover; 
    background-repeat: no-repeat; 
    background-position: center;
    ">
        <!-- Navbar -->
        <div id="navbar"></div>
    </section>

    <section id="pembayaran">
        <div class="container py-4">
            <div class="row justify-content-between">
                <div class="col-md-5">
                    <!-- Cara Bayar-->
                    <div id="caraBayar" class="py-3" data-aos="fade-in" data-aos-duration="1500" data-aos-delay="100">
                        <h2>Bagaimana Cara Melakukan Pembayaran?</h2>
                        <ol class="py-3">
                            <li>Buka E-Wallet Anda (OVO/GOPAY)</li>
                            <li>Transfer ke Nomor Tujuan <b>6281337742520</b> </li>
                            <li>Lakukan Transfer dengan Total Nominal Pemesanan</li>
                            <li>Simpan Capture Bukti Pembayaran Anda</li>
                            <li>Pada Form Pembayaran, <br> Isi Nomor Telepon yang Sama dengan yang Anda Daftarkan pada Form Pemesanan</li>
                            <li>Upload Gambar dari Bukti Pembayaran</li>
                        </ol>

                    </div>
                </div>
                <div class="col-md-6">
                    <!-- form pembayaran -->
                    <div id="formPembayaran" data-aos="flip-up" data-aos-duration="1000" data-aos-delay="200">
                        <form method="post" action="../admin/receipts-proses.php?aksi=insert" enctype="multipart/form-data" class="p-4 mb-md-0 mb-4 rounded" style="max-width: 500px; background-color: rgba(248, 249, 250, 0.5); box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);">
                            <h2>Bukti Pembayaran</h2>
                            <div class="mb-3">
                                <label class="form-label">No. Telepon</label>
                                <input type="text" name="telepon" class="form-control" placeholder="Contoh: 628xxxxxxx">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload Bukti Pembayaran</label>
                                <input type="file" name="bktBayar" class="form-control">
                                <small class="form-text text-muted">Mohon unggah bukti pembayaran dalam format JPG / JPEG / PNG.</small>
                            </div>
                            <div class="mb-3 ms-auto">
                                <button type="submit" class="btn custom-button-submit w-100">UPLOAD</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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