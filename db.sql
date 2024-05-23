CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    variant VARCHAR(50) NOT NULL UNIQUE,
    photo1 VARCHAR(225) NOT NULL,
    photo2 VARCHAR(225) NOT NULL,
    photo3 VARCHAR(225) NOT NULL,
    harga decimal(10, 2) NOT NULL,
    isi VARCHAR(50) NOT NULL,
    desc VARCHAR(50) NOT NULL,
    status VARCHAR(50) NOT NULL,
    stock INT NOT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    telepon VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    wilayah VARCHAR(50) NOT NULL,
    alamat VARCHAR(225) NOT NULL,
    variant_orders VARCHAR(50) NOT NULL,
    quantity INT NOT NULL,
    harga decimal(10, 2) NOT NULL,
    mtdBayar VARCHAR(50) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (variant_orders) REFERENCES products(variant)
);