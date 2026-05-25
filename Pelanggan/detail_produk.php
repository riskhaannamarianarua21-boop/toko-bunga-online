<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$id_produk = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM produk WHERE id_produk='$id_produk'");

$data = mysqli_fetch_assoc($query);

if(!$data){
    echo "Produk tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Produk</title>

    <link rel="stylesheet" href="detail_produk.css">
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
        <a href="index.php">Beranda</a>
        <a href="produk.php">Produk</a>
        <a href="../logout.php">Logout</a>
    </nav>

</header>

<section class="detail-container">

    <div class="detail-card">

        <div class="gambar">

            <img src="../gambar_produk/<?php echo $data['foto_produk']; ?>">

        </div>

        <div class="detail-info">

            <h1>
                <?php echo $data['nama_produk']; ?>
            </h1>

            <p class="harga">
                Rp <?php echo number_format($data['harga'],0,',','.'); ?>
            </p>

            <div class="deskripsi">

                <h3>Deskripsi Produk</h3>

                <p>
                    <?php echo $data['deskripsi']; ?>
                </p>

            </div>

            <form action="tambah_keranjang.php" method="POST">

    <input type="hidden"
    name="id_produk"
    value="<?php echo $data['id_produk']; ?>">

    <input type="number"
    name="qty"
    value="1"
    min="1"
    class="qty">

    <button type="submit" class="btn">
        Tambah ke Keranjang
    </button>

    <a href="produk.php" class="btn-kembali">
    ← Kembali ke Produk
</a>

</form>

        </div>

    </div>

</section>

<footer>
    <p>📍 Jl. Pulau Sumetera(Bahu)</p>
    <p>📞 085344119767</p>
    <p>© 2026 Toko Bunga</p>
</footer>
         <script src="assets/js/script.js"></script>
</body>
</html>
