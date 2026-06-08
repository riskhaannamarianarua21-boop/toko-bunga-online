<?php
session_start();
include "../koneksi.php";

/** @var mysqli $conn */

if (!isset($_SESSION['status_login'])) {
    header("location:../login.php");
    exit;
}

$id_produk = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM produk WHERE id_produk='$id_produk'"
);

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Produk tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="detail_produk.css">
       
       <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="ico/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="ico/favicon-16x16.png">
    <link rel="manifest" href="ico/site.webmanifest">
</head>
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
        </nav>

    </header>

    <section class="detail-container">

        <div class="detail-card">

            <div class="gambar">
                <img
                    src="../gambar_produk/<?php echo $data['foto_produk']; ?>"
                    alt="Produk"
                    onclick="bukaGambar(this.src)">
            </div>

            <div id="modalGambar" class="modal-gambar" onclick="tutupGambar()">
                <span>&times;</span>
                <img id="gambarBesar">
            </div>

            <div class="detail-info">

                <h1>
                    <?php echo $data['nama_produk']; ?>
                </h1>

                <p class="harga">
                    Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?>
                </p>

                <div class="info-produk">
                    <span>⭐ 0 Penilaian</span>
                    <span>0 Terjual</span>
                    <a href="https://wa.me/6285344119767" target="_blank">💬 Chat</a>
                </div>

                <div class="deskripsi">
                    <h3>Deskripsi Produk</h3>
                    <p><?php echo $data['deskripsi']; ?></p>
                </div>

                <form action="tambah_keranjang.php" method="POST">

                    <input type="hidden"
                        name="id_produk"
                        value="<?php echo $data['id_produk']; ?>">

                    <input type="number" name="qty" class="qty" placeholder="0" min="1">

                    <div class="aksi-detail">
                        <a href="produk.php" class="btn-kembali">← Kembali</a>

                        <button type="submit" class="btn">
                            Tambah ke Keranjang
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </section>

    <script>
        function bukaGambar(src) {
            document.getElementById("modalGambar").style.display = "flex";
            document.getElementById("gambarBesar").src = src;
        }

        function tutupGambar() {
            document.getElementById("modalGambar").style.display = "none";
        }
    </script>

</body>

<footer>
    <p>📍 Jl. Pulau Sumetera(Bahu)</p>
    <p>📞 085344119767</p>
    <p>© 2026 Toko Bunga</p>
</footer>

<script src="assets/js/script.js"></script>
</body>

</html>