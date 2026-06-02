-- =========================
-- TABEL PELANGGAN
-- =========================

CREATE TABLE pelanggan (
    id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    telephone VARCHAR(20) NOT NULL
);

-- =========================
-- TABEL PETUGAS
-- =========================

CREATE TABLE petugas (
    id_petugas INT AUTO_INCREMENT PRIMARY KEY,
    nama_petugas VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- =========================
-- TABEL PRODUK
-- =========================

CREATE TABLE produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(150) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    deskripsi TEXT NOT NULL,
    gambar VARCHAR(255) NOT NULL
);

-- =========================
-- TABEL KERANJANG
-- =========================

CREATE TABLE keranjang (
    id_keranjang INT AUTO_INCREMENT PRIMARY KEY,
    id_pelanggan INT NOT NULL,
    id_produk INT NOT NULL,
    qty INT NOT NULL,

    FOREIGN KEY (id_pelanggan)
    REFERENCES pelanggan(id_pelanggan)
    ON DELETE CASCADE,

    FOREIGN KEY (id_produk)
    REFERENCES produk(id_produk)
    ON DELETE CASCADE
);

-- =========================
-- TABEL TRANSAKSI
-- =========================

CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_pelanggan INT NOT NULL,
    tanggal DATE NOT NULL,
    total INT NOT NULL,
    status VARCHAR(100) NOT NULL,

    FOREIGN KEY (id_pelanggan)
    REFERENCES pelanggan(id_pelanggan)
    ON DELETE CASCADE
);

-- =========================
-- DETAIL TRANSAKSI
-- =========================

CREATE TABLE detail_transaksi (
    id_detail INT AUTO_INCREMENT PRIMARY KEY,
    id_transaksi INT NOT NULL,
    id_produk INT NOT NULL,
    qty INT NOT NULL,
    subtotal INT NOT NULL,

    FOREIGN KEY (id_transaksi)
    REFERENCES transaksi(id_transaksi)
    ON DELETE CASCADE,

    FOREIGN KEY (id_produk)
    REFERENCES produk(id_produk)
    ON DELETE CASCADE
);

-- =========================
-- DATA PETUGAS DEFAULT
-- =========================

INSERT INTO petugas
(nama_petugas, username, password)

VALUES

('Admin Toko Bunga', 'admin', 'admin123');

-- =========================
-- CONTOH PRODUK
-- =========================

INSERT INTO produk
(nama_produk, harga, stok, deskripsi, gambar)

VALUES

(
'Bucket Mawar Merah Classic',
150000,
12,
'Bucket bunga mawar merah elegan untuk hadiah ulang tahun dan anniversary',
'bunga1.jpg'
),

(
'Bouquet Tulip Pink',
200000,
8,
'Rangkaian bunga tulip pink cantik dan elegan',
'bunga2.jpg'
),

(
'Buket Lily Putih',
175000,
10,
'Bunga lily putih segar cocok untuk hadiah spesial',
'bunga3.jpg'
);
