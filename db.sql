CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    variant VARCHAR(50) NOT NULL,
    photo1 VARCHAR(225) NOT NULL,
    photo2 VARCHAR(225) NOT NULL,
    photo3 VARCHAR(225) NOT NULL,
    harga DECIMAL(10) NOT NULL,
    isi VARCHAR(50) NOT NULL,
    deskripsi VARCHAR(225) NOT NULL,
    stock INT NOT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    telepon VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    wilayah VARCHAR(50) NOT NULL,
    alamat VARCHAR(225) NOT NULL,
    mtdBayar VARCHAR(50) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'Menunggu Bukti Pembayaran'
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    variant VARCHAR(50) NOT NULL,
    quantity INT NOT NULL,
    harga_orders DECIMAL(10) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE admin (
    id INT(3) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

CREATE TABLE receipts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    telepon VARCHAR(50) NOT NULL,
    createdAt timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    bktBayar VARCHAR(255) NOT NULL
);