<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$produk = mysqli_query($conn, "SELECT * FROM produk");
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
$transaksi = mysqli_query($conn, "SELECT * FROM transaksi");

$jumlah_produk = mysqli_num_rows($produk);
$jumlah_pelanggan = mysqli_num_rows($pelanggan);
$jumlah_transaksi = mysqli_num_rows($transaksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Petugas</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>
    <div class="logo">
        <div class="flower">✿</div>
        <div>
            <h2>Dashboard Petugas</h2>
            <p>Toko Bunga Online</p>
        </div>
    </div>

    <nav>
    <a href="index.php">Dashboard</a>
    <a href="data_produk.php">Produk</a>
    <a href="data_pelanggan.php">Pelanggan</a>
    <a href="data_transaksi.php">Transaksi</a>
    <a href="../logout.php" class="logout">Logout</a>
</nav>
</header>

<section class="hero">
    <h1>Selamat Datang, <?php echo $_SESSION['nama_petugas']; ?></h1>
    <p>Kelola data produk, pelanggan, dan transaksi toko bunga.</p>
</section>

<main>
    <div class="dashboard-card">
        <div class="card">
            <h3>Total Produk</h3>
            <p><?php echo $jumlah_produk; ?></p>
        </div>

        <div class="card">
            <h3>Total Pelanggan</h3>
            <p><?php echo $jumlah_pelanggan; ?></p>
        </div>

        <div class="card">
            <h3>Total Transaksi</h3>
            <p><?php echo $jumlah_transaksi; ?></p>
        </div>
    </div>

    <div class="menu-box">
        <h2>Menu Petugas</h2>

        <div class="menu-list">
            <a href="data_produk.php">Kelola Produk</a>
            <a href="tambah_produk.php">Tambah Produk</a>
            <a href="data_transaksi.php">Lihat Transaksi</a>
        </div>
    </div>
</main>

<footer>
    <p>© 2026 Toko Bunga - Halaman Petugas</p>
</footer>

</body>
</html>