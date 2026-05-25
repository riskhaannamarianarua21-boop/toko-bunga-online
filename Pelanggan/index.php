<?php
session_start();
include "../koneksi.php";

/** @var mysqli $conn */

if (!isset($_SESSION['status_login'])) {
    header("location:../login.php");
    exit;
}

$produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY id_produk DESC LIMIT 6");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Beranda Pelanggan</title>
    <link rel="stylesheet" href="CSS/Pelanggan.css">
</head>

<body>

    <header>
        <div class="logo">
            <div class="flower">✿</div>
            <div>
                <h2>Toko Bunga</h2>
                <p>Bunga Indah, Momen Berkesan</p>
            </div>
        </div>

        <nav>
            <a href="index.php" class="active">Beranda</a>
            <a href="produk.php">Produk</a>
            <a href="keranjang.php">Keranjang</a>
            <a href="checkout.php">Checkout</a>
            <a href="../logout.php" class="logout">Logout</a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-text">
            <h1>Selamat Datang, <?php echo $_SESSION['nama_pelanggan']; ?></h1>
            <p>
                Temukan berbagai pilihan bunga indah untuk hadiah,
                dekorasi, dan momen spesial Anda.
            </p>
            <a href="produk.php" class="btn">Lihat Produk</a>
        </div>

        <div class="hero-img">
            <img src="../bunga.jpg" alt="Bunga">
        </div>
    </section>

    <section class="section-title">
        <h2>Produk Terbaru</h2>
        <p>Pilihan bunga terbaik dari toko kami</p>
    </section>

    <section class="produk-container">

        <?php while ($row = mysqli_fetch_assoc($produk)) { ?>

            <div class="produk-card">
                <img src="../gambar_produk/<?php echo $row['gambar']; ?>" alt="Produk">

                <div class="produk-info">
                    <h3><?php echo $row['nama_produk']; ?></h3>

                    <p class="harga">
                        Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                    </p>

                    <a href="detail_produk.php?id=<?php echo $row['id_produk']; ?>" class="btn-detail">
                        Detail
                    </a>
                </div>
            </div>

        <?php } ?>

    </section>

    <footer>
        <p>📍 Jl. Pulau Sumetera(Bahu)</p>
        <p>📞 085344119767</p>
        <p>© 2026 Toko Bunga</p>
    </footer>

</body>

</html>