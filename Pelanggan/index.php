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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="ico/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="ico/favicon-16x16.png">
    <link rel="manifest" href="ico/site.webmanifest">
    <style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    font-family: Arial, sans-serif;
    background: #fff7fb;
    color: #333;
}

header {
    height: 70px;
    background: white;
    padding: 0 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 3px 15px rgba(0,0,0,0.08);
}

.logo {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-left: -60px;
}

.flower {
    font-size: 34px;
    color: #d6336c;
}

.logo h2 {
    color: #9b174c;
    font-size: 24px;
}

.logo p {
    font-size: 12px;
    color: #666;
}

nav a{
    text-decoration: none;
    color: #333;
    font-weight: bold;
    padding: 10px 18px;
    border-radius: 8px;
    display: inline-block;
}

nav a:hover{
    background: #fde8f1;
    color: #c2185b;
}

nav a.active{
    background: #c2185b;
    color: white;
}

.logout{
    background: #444;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
}

.logout:hover{
    background: #111;
    color: white;
}

.hero{
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 65px 90px;
    background: #fde8f1;
}

.hero-text{
    width: 50%;
}

.hero-text h1{
    font-size: 42px;
    color: #c2185b;
    margin-bottom: 18px;
}

.hero-text p{
    font-size: 18px;
    line-height: 1.7;
    color: #555;
    margin-bottom: 28px;
}

.btn{
    display: inline-block;
    padding: 14px 28px;

    background: #c2185b;
    color: white;

    text-decoration: none;
    border-radius: 8px;

    font-weight: bold;
}

.btn:hover{
    background: #9b174c;
}

.hero-img img{
    width: 360px;
    border-radius: 15px;
}

.section-title{
    text-align: center;
    padding: 45px 20px 20px;
}

.section-title h2{
    font-size: 32px;
    color: #c2185b;
}

.section-title p{
    margin-top: 8px;
    color: #666;
}

.produk-container{
    padding: 30px 70px 60px;

    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
}

.produk-card{
    background: white;
    border-radius: 12px;
    overflow: hidden;

    box-shadow: 0 5px 18px rgba(0,0,0,0.12);
}

.produk-card img{
    width: 100%;
    height: 300px;
    object-fit: contain;
    background: #fff7fb;
}

.produk-info{
    padding: 20px;
}

.produk-info h3{
    color: #9b174c;
    font-size: 22px;
    margin-bottom: 10px;
}

.harga{
    color: #c2185b;
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 8px;
}

.stok{
    font-size: 14px;
    margin-bottom: 15px;
}

.btn-detail{
    display: block;
    text-align: center;

    padding: 12px;

    background: #c2185b;
    color: white;

    text-decoration: none;
    border-radius: 8px;

    font-weight: bold;
}

.btn-detail:hover{
    background: #9b174c;
}

footer{
    height: 45px;
    margin-top: 0;
    background: #9b174c;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 35px;
    font-size: 15px;
}

.cart-icon{
    font-size: 15px;
    padding: 8px 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.settings-icon{
    color: #777;
    padding: 10px 16px;
    border-radius: 8px;
    font-size: 18px;
    text-decoration: none;
}

.settings-icon:hover{
    background: #fde8f1;
    color: #c2185b;
}

</style>
    <title>Beranda Pelanggan</title>
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
            <a href="keranjang.php" class="cart-icon">🛒</a>
            <a href="index.php" class="active">Beranda</a>
            <a href="produk.php">Produk</a>
            <a href="checkout.php">Checkout</a>
            <a href="pengaturan.php" class="settings-icon">⚙️</a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-text">
            <marquee behavior="scroll" direction="left" scrollamount="10">

                <h1>
                    🌸 Selamat Datang,
                    <?php echo $_SESSION['nama_pelanggan']; ?>
                    di Toko Bunga Online 🌸
                </h1>

            </marquee>
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

            <div class="produk-card" data-nama="<?php echo strtolower($row['nama_produk']); ?>">
                <img src="../gambar_produk/<?php echo $row['foto_produk']; ?>" alt="Produk">

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
<script src="assets/js/script.js"></script>

</html>