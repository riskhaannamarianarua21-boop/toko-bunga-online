<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

if(isset($_POST['simpan'])){

    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp,
    "../gambar_produk/".$gambar);

    $insert = mysqli_query($conn,
    "INSERT INTO produk
    (nama_produk, harga, stok, deskripsi, gambar)

    VALUES

    ('$nama_produk',
    '$harga',
    '$stok',
    '$deskripsi',
    '$gambar')");

    if($insert){

        echo "
        <script>
            alert('Produk berhasil ditambahkan');
            location.href='data_produk.php';
        </script>
        ";

    }else{

        echo "
        <script>
            alert('Gagal menambahkan produk');
        </script>
        ";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>

    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>

    <div class="logo">

        <div class="flower">✿</div>

        <div>
            <h2>Tambah Produk</h2>
            <p>Toko Bunga Online</p>
        </div>

    </div>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="data_produk.php">Produk</a>
        <a href="../logout.php" class="logout">Logout</a>
    </nav>

</header>

<section class="hero">

    <h1>Tambah Produk Baru</h1>

    <p>
        Tambahkan produk bunga terbaru ke toko.
    </p>

</section>

<main>

    <div class="form-box">

        <form method="POST" enctype="multipart/form-data">

            <label>Nama Produk</label>

            <input type="text"
            name="nama_produk"
            required>

            <label>Harga Produk</label>

            <input type="number"
            name="harga"
            required>

            <label>Stok Produk</label>

            <input type="number"
            name="stok"
            required>

            <label>Deskripsi Produk</label>

            <textarea
            name="deskripsi"
            required></textarea>

            <label>Gambar Produk</label>

            <input type="file"
            name="gambar"
            required>

            <button type="submit"
            name="simpan"
            class="btn-simpan">

                Simpan Produk

            </button>

        </form>

    </div>

</main>

<footer>

    <p>© 2026 Toko Bunga - Halaman Petugas</p>

</footer>

</body>
</html>