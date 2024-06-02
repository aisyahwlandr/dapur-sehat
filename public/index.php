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

        <!-- main-section -->
        <div class="container py-5">
            <div class="text-center">
                <h1 class="title">Frozen Food Rumahan Berkualitas!</h1>
                <p>Selamat datang di Dapur Sehat. Kami menyediakan kelezatan produk rumahan yang menggugah selera bagi
                    setiap penikmatnya dan terbuat dari bahan pilihan bebas pengawet dan higienis.
                </p>
                <div>
                    <a href="#produk">
                        <button type="button" class="btn fw-bold custom-button-submit">Order Sekarang</button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- whyus -->
    <section id="whyus">
        <div class="container py-2">
            <div class="text-md-start text-center">
                <h1 class="title py-2">Apa yang membuat produk kami istimewa?</h1>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-3 border-0">
                        <div class="card-body text-center">
                            <img class="mb-3" width="50px" src="images/higienis.png" alt="complete">
                            <h5>Higienis</h5>
                            <p>Dibuat dengan mengutamakan kebersihan dan keamanan dari setiap bahan
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3 border-0">
                        <div class="card-body text-center">
                            <img class="mb-3" width="50px" src="images/bebaspengawet.png" alt="price">
                            <h5>Bebas Pengawet</h5>
                            <p>Tanpa bahan pengawet kimia sehingga aman untuk dikonsumsi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3 border-0">
                        <div class="card-body text-center">
                            <img class="mb-3" width="50px" src="images/fresh.png" alt="24hours">
                            <h5>Fresh</h5>
                            <p>Selalu menjaga kesegaran produk dengan kualitas bahan terbaik </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3 border-0">
                        <div class="card-body text-center">
                            <img class="mb-3" width="50px" src="images/halal.png" alt="professional">
                            <h5>Halal</h5>
                            <p>Produk kami diproses dan dibuat menggunakan bahan halal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pemesanan -->
    <section id="alurPemesanan">
        <div class="container py-2">
            <div class="text-md-start text-center">
                <h1 class="title py-2">Alur Pemesanan</h1>
                <div class="row">
                    <div class="col-md-6">
                        <p>Proses 1</p>
                        <div class="d-flex gap-md-3 gap-1 pb-4">
                            <div class="bg-secondary align-content-center text-center custom-paragraf-bold alur-body" style="font-size: 0.8rem; width: 90px; height: 60px; border-radius: 10px;">Pilih Produk
                            </div>
                            <i class="bi bi-arrow-right alur-icon align-content-center" style="font-size: 2rem; color: cornflowerblue;"></i>
                            <div class="bg-secondary align-content-center text-center custom-paragraf-bold alur-body" style="font-size: 0.8rem; width: 90px; height: 60px; border-radius: 10px;">Isi Data
                            </div>
                            <i class="bi bi-arrow-right alur-icon align-content-center" style="font-size: 2rem; color: cornflowerblue;"></i>
                            <div class="bg-secondary align-content-center text-center custom-paragraf-bold alur-body" style="font-size: 0.8rem; width: 90px; height: 60px; border-radius: 10px;">Lakukan
                                Pembayaran</div>
                            <i class="bi bi-arrow-right alur-icon align-content-center" style="font-size: 2rem; color: cornflowerblue;"></i>
                            <div class="bg-secondary align-content-center text-center custom-paragraf-bold alur-body" style="font-size: 0.8rem; width: 90px; height: 60px; border-radius: 10px;">Upload Bukti
                                Pembayaran</div>
                        </div>
                        <p>Proses 2</p>
                        <div class="d-flex gap-md-3 gap-1 pb-4">
                            <div class="bg-success align-content-center text-center custom-paragraf-bold alur-body" style="font-size: 0.8rem; width: 90px; height: 60px; border-radius: 10px;">Bukti Bayar
                                Terkonfirmasi</div>
                            <i class="bi bi-arrow-right alur-icon align-content-center" style="font-size: 2rem; color: cornflowerblue;"></i>
                            <div class="bg-warning align-content-center text-center custom-paragraf-bold alur-body" style="font-size: 0.8rem; width: 90px; height: 60px; border-radius: 10px;">Pesanan
                                Diproses
                            </div>
                            <i class="bi bi-arrow-right alur-icon align-content-center" style="font-size: 2rem; color: cornflowerblue;"></i>
                            <div class="bg-info align-content-center text-center custom-paragraf-bold alur-body" style="font-size: 0.8rem; width: 90px; height: 60px; border-radius: 10px;">Pesanan
                                Diantar
                            </div>
                            <i class="bi bi-arrow-right alur-icon align-content-center" style="font-size: 2rem; color: cornflowerblue;"></i>
                            <div class="bg-primary align-content-center text-center custom-paragraf-bold alur-body" style="font-size: 0.8rem; width: 90px; height: 60px; border-radius: 10px;">Pesanan
                                Diterima Pemesan
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 align-content-center text-center">
                        <p class="custom-paragraf fw-bold px-5 pt-3">*Pelanggan dapat mengecek status pesanan dengan
                            memasukkan nomor
                            telepon di kolom cek pesanan.</p>
                        <form role="search" action="cari-pesanan.php" method="get">
                            <div class="search my-md-0 my-3">
                                <input id="searchInput" placeholder="Cek Pesanan..." type="text">
                                <button id="searchButton" type="submit"><img src="images/search.svg" width="20px" alt="search"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>

    <!-- produk -->
    <section id="produk">
        <div class="container py-2">
            <div class="text-md-start text-center">
                <h1 class="title py-2">Produk</h1>
            </div>
            <div class="row my-3">
                <?php
                $result = mysqli_query($db, "SELECT * FROM products");
                $counter = 0; // Counter untuk menghasilkan ID yang unik
                while ($row = mysqli_fetch_object($result)) {
                    $counter++; // Increment counter setiap kali loop
                ?>
                    <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card mb-3 shadow d-flex flex-column">
                            <div class="card-body">
                                <!-- Carousel Bootstrap -->
                                <h4>Tersedia: <?= $row->stock ?></h4>
                                <div id="productCarousel<?= $counter ?>" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="../admin/uploads/products/<?= $row->photo1 ?>" class="d-block w-100 h-100 rounded card-image mb-3" alt="Photo1">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../admin/uploads/products/<?= $row->photo2 ?>" class="d-block w-100 h-100 rounded card-image mb-3" alt="Photo2">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../admin/uploads/products/<?= $row->photo3 ?>" class="d-block w-100 h-100 rounded card-image mb-3" alt="variantLogo">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel<?= $counter ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel<?= $counter ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <!-- End of Carousel -->
                                <h5 class="custom-card-title"><?= $row->variant ?></h5>
                                <p>Rp <?= $row->harga ?> / kotak (isi <?= $row->isi ?>)</p>
                                <p class="custom-paragraf" style="text-align: justify;"><?= $row->deskripsi ?></p>
                            </div>
                            <div class="mb-3">
                                <a class="d-flex align-items-center justify-content-center button-order" href="pemesanan.php">
                                    <button type="button" class="btn fw-bold">Order</button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" style="
    background-image: url('images/bgbottom.svg'); 
    background-size: cover; 
    background-repeat: no-repeat; 
    background-position: center;
    ">
        <div class="container-fluid mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <h1 class="title justify-content-start">Frequently Asked Question</h1>
                        <p class="custom-paragraf">Kesulitan melakukan pemesanan? Silahkan temukan jawaban anda disini
                        </p>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="custom-paragraf">Bagaimana cara melakukan pembayaran?</span>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body custom-paragraf">
                                        <p>Pilih Menu Pembayaran > Masukkan No Telp Pemesan > Upload Bukti Pembayaran
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <span class="custom-paragraf">Metode Pembayaran apa saja yang tersedia?</span>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body custom-paragraf">
                                        <p>OVO dan GOPAY </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <span class="custom-paragraf">Berapa hari produk dapat bertahan?</span>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body custom-paragraf">
                                        <p>Produk dapat bertahan maksimal <b>3 minggu</b> setelah pesanan dikirim dan
                                            <b>harus berada di dalam freezer</b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <span class="custom-paragraf">Apakah Ada biaya pesan-antar?</span>
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body custom-paragraf">
                                        <p><b>Tidak dikenakan</b> biaya pesan-antar</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <span class="custom-paragraf">Bagaimana cara cek progress pesanan?</span>
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body custom-paragraf">
                                        <p>Pelanggan dapat mengecek progress pemesanan dengan memasukkan <b>nomor
                                                telepon</b> di kolom <b>cek pesanan</b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        <span class="custom-paragraf">Kapan pesanan diantar?</span>
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body custom-paragraf">
                                        <p>Setelah Bukti Pembayaran terkonfirmasi dan pesanan diproses, pesanan paling lambat diantar 3 hari setelah diproses</p>
                                    </div>
                                </div>
                            </div>
                        </div>
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