class App {
    constructor() {
        this.navbarSection = document.getElementById("navbar");
        this.footerSection = document.getElementById("footer");
    }

    renderNavbar() {
        const content = `
        <nav class="navbar navbar-expand-md py-3">
            <div class="container">
                <a class="navbar-brand" href="index.html"><img width="120px" src="images/logo.png" alt="Logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end pt-2" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel" style="width: 50%;">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Dapur Sehat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav ms-auto"> <!-- Changed ms-auto to mx-auto -->
                            <li class="nav-item">
                                <a class="nav-link" href="index.html#produk">Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.html">Tentang Kami</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.html#faq">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pembayaran.html"">Pembayaran</a>
                            </li>
                            <li class=" nav-item mx-md-2 align-content-center">
                                    <form role="search" action="cari-pesanan.php" method="get">
                                        <div class="search my-md-0 my-3">
                                            <input id="searchInput" placeholder="Cek Pesanan..." type="text">
                                            <button id="searchButton" type="submit"><img src="images/search.svg"
                                                    width="20px" alt="search"></button>
                                        </div>
                                    </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        `

        this.navbarSection.innerHTML = content;
    };

    renderFooter() {
        const content = `
        <div class="container">
            <footer class="row py-5">
                <div class="col-md-3 mb-3">
                    <p class="custom-paragraf-bold">Jalan Mahoni Raya No.6, Cisauk, Kabupaten Tangerang
                    </p>
                </div>
                <div class="col-md-3 mb-3">
                    <ul class="navbar-nav flex-column ms-md-5">
                        <li class="nav-item mb-2">
                            <a href="index.html#produk" class="custom-paragraf-bold pt-0-bold">Produk</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="about.html" class="custom-paragraf-bold pt-0-bold">Tentang Kami</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="index.html#faq" class="custom-paragraf-bold pt-0-bold">FAQ</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="pembayaran.html" class="custom-paragraf-bold pt-0-bold">Pembayaran</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <p align="justify" class="custom-paragraf-bold">Kontak Kami</p>
                    <ul class="nav gap-2 mb-3">
                        <li class="nav-item">
                            <a href="https://www.whatsapp.com" target="_blank" class="nav-link p-0">
                                <img src="images/whatsapp.svg" alt="whatsapp">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.gmail.com" target="_blank" class="nav-link p-0">
                                <img src="images/gmail.svg" alt="gmail">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 mb-3">
                    <p align="justify" class="custom-paragraf-bold">Copyright Dapur Sehat 2024</p>
                    <img width="100px" src="images/logo.png" alt="Logo">
                </div>
            </footer>
        </div>
    `;

        this.footerSection.innerHTML = content;
    };

    init() {
        this.renderNavbar();
        this.renderFooter();
    };
};

// Inisialisasi App setelah DOM dimuat
document.addEventListener("DOMContentLoaded", function () {
    const app = new App();
    app.init();
});
