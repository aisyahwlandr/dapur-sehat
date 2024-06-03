<?php
include './connection.php';
require './vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// Get the order ID from the request (e.g., via GET method)
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;

// Check if order_id is provided
if ($order_id === null) {
    die('Order ID is required');
}

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// Fetch data from the database based on the provided order ID
$hasil = mysqli_query($db, "
    SELECT
        o.id,
        o.nama,
        o.telepon,
        o.email,
        o.wilayah,
        o.alamat,
        o.mtdBayar,
        o.order_date,
        o.status,
        GROUP_CONCAT(oi.product_id) AS product_id,
        GROUP_CONCAT(p.variant) AS variant,
        GROUP_CONCAT(oi.quantity) AS quantity,
        SUM(oi.harga_orders) AS harga_orders
    FROM
        orders o
    JOIN
        order_items oi ON o.id = oi.order_id
    JOIN
        products p ON oi.product_id = p.id
    WHERE
        o.id = $order_id
    GROUP BY
        o.id, o.nama, o.telepon, o.email, o.wilayah, o.alamat, o.mtdBayar, o.order_date, o.status
");

// Check if the order exists
if (mysqli_num_rows($hasil) == 0) {
    die('Order not found');
}

// Build HTML content with styling
$html = '
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        h2 {
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .header, .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #888;
        }
    </style>
    <div class="header">
        <h2>Dapur Sehat - Pesanan</h2>
    </div>
';

while ($row = mysqli_fetch_object($hasil)) {
    $html .= '
    <table>
        <tr>
            <th>ID Pesanan</th>
            <td>' . $row->id . '</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>' . $row->nama . '</td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td>' . $row->telepon . '</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>' . $row->email . '</td>
        </tr>
        <tr>
            <th>Wilayah</th>
            <td>' . $row->wilayah . '</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>' . $row->alamat . '</td>
        </tr>
        <tr>
            <th>Variant</th>
            <td>' . $row->variant . '</td>
        </tr>
        <tr>
            <th>Variant ID</th>
            <td>' . $row->product_id . '</td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>' . $row->quantity . '</td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>' . $row->harga_orders . '</td>
        </tr>
        <tr>
            <th>Metode Pembayaran</th>
            <td>' . $row->mtdBayar . '</td>
        </tr>
        <tr>
            <th>Waktu Order</th>
            <td>' . $row->order_date . '</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>' . $row->status . '</td>
        </tr>
    </table>';
}

$html .= '
    <div class="footer">
        <p>&copy; 2024 Dapur Sehat. All rights reserved.</p>
    </div>
';

// Load HTML content into Dompdf
$dompdf->loadHtml($html);

// Setup the paper size and orientation to portrait
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('DapurSehat-Pesanan.pdf');
?>
