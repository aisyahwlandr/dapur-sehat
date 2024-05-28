<?php
session_start();
include '../connection.php';

// Periksa apakah sesi email telah disetel
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
    header("Location: ../auth/auth.php");
    exit();
}

// Validasi ID yang ada di URL dengan ID yang ada di sesi
$id = $_GET['id'] ?? null;
if ($id !== $_SESSION['id']) {
    header("Location: ../auth/auth.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="dashboard.css">
    <title>Admin Dapur Sehat</title>
</head>

<body style="background-color: #DADDFC;">
    <header>
        <div class="px-3 py-2 border-bottom"
            style="background-image: linear-gradient(180deg, rgba(141, 139, 226, 1), rgba(253, 187, 203, 1));">
            <div class="container">
                <div class="py-2 d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <?php
                    $result = mysqli_query($db, "SELECT * FROM admin WHERE id='$_GET[id]'");

                    while ($row = mysqli_fetch_object($result)) {
                    ?>
                    <a href="dashboard.php?id=<?php echo $row->id; ?>"
                        class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-blue-custom text-decoration-none">
                        <img width="120px" src="../public/images/logo.png" alt="Logo">
                    </a>
                    <ul
                        class="nav col-12 col-lg-auto my-2 justify-content-center align-items-center my-md-0 text-small">
                        <li>
                            <a href="dashboard.php?id=<?php echo $row->id; ?>"
                                class="nav-link text-blue-custom rounded">
                                <i class="bi bi-house-door"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="dashboard.php?id=<?php echo $row->id; ?>&page=products"
                                class="nav-link text-blue-custom rounded">
                                <i class="bi bi-grid"></i>
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="dashboard.php?id=<?php echo $row->id; ?>&page=orders"
                                class="nav-link text-blue-custom rounded">
                                <i class="bi bi-bag"></i>
                                Orders
                            </a>
                        </li>
                        <li>
                            <a href="dashboard.php?id=<?php echo $row->id; ?>&page=receipts"
                                class="nav-link text-blue-custom rounded">
                                <i class="bi bi-receipt"></i>
                                Receipts
                            </a>
                        </li>
                        <li>
                            <p class="navbar-text mt-3 mx-3 fw-bold">
                                Hi <?php echo $row->username ?> !</p>
                        </li>
                        <li>
                            <a href="../auth/logout.php">
                                <button id="logoutButton" type="button" class="btn btn-danger">LogOut</button>
                            </a>
                        </li>
                    </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>

    <div class="container py-4 table-responsive">
        <main>
            <table class="table table-hover text-center" data-aos="fade-down">
                <tr class="table-dark">
                    <th>No</th>
                    <th>Id</th>
                    <th>No. Telepon</th>
                    <th>Created At</th>
                    <th>Bukti Pembayaran</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $no = 0;
                if (isset($_GET['tcari'])) {
                    $keyword = isset($_GET['tcari']) ? $_GET['tcari'] : '';

                    $query = "SELECT * FROM receipts WHERE telepon LIKE '%$keyword%'";
                    $result = mysqli_query($db, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_object($result)) {
                            $no++;
                            echo '<tr>';
                            echo '<td>' . $no . '</td>';
                            echo '<td>' . $row->id . '</td>';
                            echo '<td>' . $row->telepon . '</td>';
                            echo '<td>' . $row->createdAt . '</td>';
                            echo '<td>';
                            echo '<button class="btn btn-primary" onclick="showReceipt(\'' . $row->bktBayar . '\')">Lihat</button>';
                            echo '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-danger" href="aksi-proses.php?aksi=delete&id=' . $row->id . '">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '
                            <h5>Terjadi kesalahan dalam mengambil data.</h5>
                        ';
                    }
                } else {
                    echo '
                        <h5>Tidak ada data.</h5>
                    ';
                }
                ?>
            </table>
        </main>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="receiptModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="receiptImage" src="" alt="Bukti Pembayaran" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Import Bootsrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Import AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init({
        once: true,
    });
    </script>

    <!-- Popup Receipts -->
    <script>
    function showReceipt(imageSrc) {
        // Menambahkan path yang diinginkan sebelum nama file gambar
        var imagePath = "./uploads/receipts/" + imageSrc;
        document.getElementById('receiptImage').src = imagePath;
        var myModal = new bootstrap.Modal(document.getElementById('receiptModal'), {
            keyboard: false
        });
        myModal.show();
    }
    </script>
</body>

</html>