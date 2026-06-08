<?php
session_start();
include "../koneksi.php";

/** @var mysqli $conn */

if (!isset($_SESSION['status_login'])) {
    header("location:../login.php");
    exit;
}

$keyword = isset($_GET['cari']) ? $_GET['cari'] : "";

$produk = mysqli_query($conn, "SELECT * FROM produk 
WHERE nama_produk LIKE '%$keyword%'
ORDER BY id_produk DESC");

if (!$produk) {
    die("Query produk gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Produk Toko Bunga</title>
    <link rel="stylesheet" href="produk.css">
    
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="ico/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="ico/favicon-16x16.png">
    <link rel="manifest" href="ico/site.webmanifest">
    
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
            <form action="produk.php" method="GET" class="search-form">
                <input type="text" name="cari" placeholder="🔍 Cari produk..." value="">
                <button type="submit">Cari</button>

                <?php if ($keyword != "") { ?>
                    <a href="produk.php" class="btn-reset">Reset</a>
                <?php } ?>
            </form>
            <a href="keranjang.php" class="cart-icon">🛒</a>
            <a href="index.php">Beranda</a>
            <a href="produk.php" class="active">Produk</a>
            <a href="checkout.php">Checkout</a>
            <a href="pengaturan.php" class="settings-icon">⚙️</a>
        </nav>
    </header>

    <section class="hero">
        <h1>Katalog Produk Bunga</h1>
        <p>Pilihan bunga terbaik untuk orang tersayang.</p>
    </section>

    <section class="produk-container">

        <?php if (mysqli_num_rows($produk) > 0) { ?>

            <?php while ($row = mysqli_fetch_assoc($produk)) { ?>

                <div class="card">

                    <img
                        src="../gambar_produk/<?php echo htmlspecialchars($row['foto_produk']); ?>"
                        alt="<?php echo htmlspecialchars($row['nama_produk']); ?>">

                    <div class="card-body">

                        <h3>
                            <?php echo htmlspecialchars($row['nama_produk']); ?>
                        </h3>

                        <p class="harga">
                            Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                        </p>

                        <p class="deskripsi">
                            <?php echo htmlspecialchars($row['deskripsi']); ?>
                        </p>

                        <a href="detail_produk.php?id=<?php echo $row['id_produk']; ?>" class="btn">
                            Detail Produk
                        </a>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <p>Belum ada produk bunga.</p>

        <?php } ?>

    </section>

    <footer>
        <p>📍 Jl. Pulau Sumetera(Bahu)</p>
        <p>📞 085344119767</p>
        <p>© 2026 Toko Bunga</p>
    </footer>

</body>

</html>