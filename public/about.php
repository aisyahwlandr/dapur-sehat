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

    <!-- about -->
    <section id="about">
        <div class="container py-2">
            <h1 class="title py-2"  data-aos="fade-right" data-aos-delay="100">Tertarik Mengenal Dapur Sehat?</h1>
            <p  data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="100" align="justify">Dapur Sehat merupakan rumah usaha produk frozen food homemade yang dijalankan sejak tahun 2022 sebagai usaha rumahan keluarga yang bertempatkan di Cisauk, Kabupaten Tangerang. Meskipun masih tergolong baru, usaha ini telah mendapatkan perhatian dari masyarakat sekitar karena kualitas dan kelezatan produknya. Frozen Food atau dapat dikenal sebagai makanan beku merupakan makanan yang telah dimasak setengah matang untuk kemudian secara sengaja dibekukan dengan freezer agar dapat mempertahankan kualitas dari makanan yang dibekukan tersebut. Proses pembekuan ini sangat penting karena membantu mencegah pertumbuhan bakteri dan menjaga nutrisi dalam makanan. Frozen Food dibuat dengan tujuan agar makanan dapat bertahan dalam waktu lama dengan cara diawetkan melalui proses pembekuan, sehingga makanan bisa disimpan dan sewaktu diinginkan bisa langsung dimasak. Ini sangat praktis bagi keluarga modern yang membutuhkan solusi cepat dan mudah dalam menyiapkan makanan sehari-hari.<br>
            Produk yang dijual Dapur Sehat antara lain Nugget Ayam Original, Nugget Ayam Keju, Nugget Pisang, Bakso Sapi, dan Kentang Goreng Beku. Semua produk ini dibuat dengan bahan-bahan berkualitas tinggi dan tanpa bahan pengawet tambahan, menjadikannya pilihan yang sehat dan aman untuk dikonsumsi oleh semua anggota keluarga. Dalam kurun waktu 2022 sampai saat ini, Dapur Sehat hanya melayani pengiriman pesanan untuk daerah sekitar Tangerang Selatan, Cisauk, dan Area Kampus K Universitas Gunadarma. Dengan komitmen terhadap kualitas dan pelayanan, Dapur Sehat terus berinovasi untuk memenuhi kebutuhan konsumennya.
            </p>
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