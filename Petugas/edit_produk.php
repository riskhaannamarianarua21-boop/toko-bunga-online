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

if(isset($_POST['update'])){

    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    if($_FILES['gambar']['name'] != ""){

        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        move_uploaded_file($tmp,
        "../gambar_produk/".$gambar);

        $update = mysqli_query($conn,
        "UPDATE produk SET

        nama_produk='$nama_produk',
        harga='$harga',
        deskripsi='$deskripsi',
        gambar='$gambar'

        WHERE id_produk='$id_produk'");

    }else{

        $update = mysqli_query($conn,
        "UPDATE produk SET

        nama_produk='$nama_produk',
        harga='$harga',
        deskripsi='$deskripsi'

        WHERE id_produk='$id_produk'");

    }

    if($update){

        echo "
        <script>
            alert('Produk berhasil diupdate');
            location.href='data_produk.php';
        </script>
        ";

    }else{

        echo "
        <script>
            alert('Gagal update produk');
        </script>
        ";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>

    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>

    <div class="logo">

        <div class="flower">✿</div>

        <div>
            <h2>Edit Produk</h2>
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

    <h1>Edit Produk</h1>

    <p>
        Perbarui data produk bunga.
    </p>

</section>

<main>

    <div class="form-box">

        <form method="POST" enctype="multipart/form-data">

            <label>Nama Produk</label>

            <input type="text"
            name="nama_produk"
            value="<?php echo $data['nama_produk']; ?>"
            required>

            <label>Harga Produk</label>

            <input type="number"
            name="harga"
            value="<?php echo $data['harga']; ?>"
            required>

            <label>Deskripsi Produk</label>

            <textarea
            name="deskripsi"
            required><?php echo $data['deskripsi']; ?></textarea>

            <label>Gambar Saat Ini</label>

            <img src="../gambar_produk/<?php echo $data['foto_produk']; ?>" class="preview">

            <label>Upload Gambar Baru</label>

            <input type="file"
            name="gambar">

            <button type="submit"
            name="update"
            class="btn-simpan">

                Update Produk

            </button>

        </form>

    </div>

</main>

<footer>

    <p>© 2026 Toko Bunga - Halaman Petugas</p>

</footer>

</body>
</html>