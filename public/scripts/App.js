class App {
    constructor() {
        this.navbarSection = document.getElementById("navbar");
        this.footerSection = document.getElementById("footer");
    }

    renderNavbar() {
        const content = `
        <nav class="navbar navbar-expand-md py-3">
            <div class="container">
                <a class="navbar-brand" href="index.php"><img width="120px" src="images/logo.png" alt="Logo"></a>
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
                        <ul class="navbar-nav custom-navbar ms-auto"> <!-- Changed ms-auto to mx-auto -->
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#produk">Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pembayaran.php">Pembayaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.php">Tentang Kami</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#faq">FAQ</a>
                            </li>
                            <li class="nav-item mx-md-2 align-content-center">
                                <form id="searchForm" class='mb-3 float-end' action="cari-pesanan.php" method='GET'>
                                    <div class='search'>
                                        <input id='searchInput' type='text' name='tcari' value='${this.getSearchQuery()}' class='form-control' placeholder='Cari Pesanan...' aria-label='Search'>
                                        <button id="searchButton" type="submit">
                                            <img src="images/search.svg" width="20px" alt="search">
                                        </button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        `;

        this.navbarSection.innerHTML = content;

        // Menambahkan event listener untuk form pencarian
        document.getElementById("searchForm").addEventListener("submit", this.handleSearch.bind(this));
    }

    handleSearch(event) {
        // Mendapatkan nilai pencarian dari input
        const searchTerm = document.getElementById("searchInput").value.trim();
        console.log("Search term:", searchTerm); // Tambahkan ini
        // Mengecek apakah nilai pencarian tidak kosong
        if (searchTerm === "") {
            // Menghentikan perilaku default form jika nilai pencarian kosong
            event.preventDefault();
        }
    }

    getSearchQuery() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('tcari') || '';
    }

    renderFooter() {
        const content = `
        <div class="container">
            <footer class="row py-md-5 py-3">
                <div class="col-md-3 mb-3">
                    <p class="custom-paragraf-bold">Jalan Mahoni Raya No.6, Cisauk, Kabupaten Tangerang
                    </p>
                </div>
                <div class="col-md-3 mb-3">
                    <ul class="navbar-nav flex-column ms-md-5">
                        <li class="nav-item mb-2">
                            <a href="index.php#produk" class="custom-paragraf-bold pt-0-bold">Produk</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="about.php" class="custom-paragraf-bold pt-0-bold">Tentang Kami</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="index.php#faq" class="custom-paragraf-bold pt-0-bold">FAQ</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="pembayaran.php" class="custom-paragraf-bold pt-0-bold">Pembayaran</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <p align="justify" class="custom-paragraf-bold">Kontak Kami</p>
                    <ul class="nav gap-2 mb-3">
                        <li class="nav-item">
                            <a href="https://api.whatsapp.com/send?phone=6281337742520&text=Halo%2C%20Dapur%20Sehat!%20Saya%20memiliki%20kendala.%20Bisakah%20Dapur%20Sehat%20membantu%20saya%3F" target="_blank" class="nav-link p-0">
                                <img src="images/whatsapp.svg" alt="whatsapp">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="mailto:ashndr10@gmail.com?subject=Kontak%20Dapur%20Sehat&body=Halo,%20Dapur%20Sehat!%20Saya%20memiliki%20kendala,%20Bisakah%20Dapur%20Sehat%20membantu%20saya%3F%0A%0ANama%20Saya:%20%0ATelepon%20Saya:%20%0AKendala%20Saya:%20" target="_blank" class="nav-link p-0">
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
    }

    init() {
        this.renderNavbar();
        this.renderFooter();
    }
}

// Inisialisasi App setelah DOM dimuat
document.addEventListener("DOMContentLoaded", function () {
    const app = new App();
    app.init();
});
