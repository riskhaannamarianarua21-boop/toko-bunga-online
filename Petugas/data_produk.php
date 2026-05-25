<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$produk = mysqli_query($conn,
"SELECT * FROM produk ORDER BY id_produk DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Produk</title>

    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>

    <div class="logo">

        <div class="flower">✿</div>

        <div>
            <h2>Data Produk</h2>
            <p>Toko Bunga Online</p>
        </div>

    </div>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="data_produk.php">Produk</a>
        <a href="data_transaksi.php">Transaksi</a>
        <a href="../logout.php" class="logout">Logout</a>
    </nav>

</header>

<section class="hero">

    <h1>Kelola Produk Bunga</h1>

    <p>
        Tambah, edit, dan hapus produk bunga.
    </p>

</section>

<main>

    <div class="table-box">

        <div class="table-header">

            <h2>Daftar Produk</h2>

            <a href="tambah_produk.php" class="btn-tambah">
                + Tambah Produk
            </a>

        </div>

        <table>

            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;

            while($row = mysqli_fetch_assoc($produk)){
            ?>

            <tr>

                <td><?php echo $no++; ?></td>

                <td>
                    <img src="../gambar_produk/<?php echo $row['gambar']; ?>" class="gambar">
                </td>

                <td>
                    <?php echo $row['nama_produk']; ?>
                </td>

                <td>
                    Rp <?php echo number_format($row['harga'],0,',','.'); ?>
                </td>

                <td>

                    <a href="edit_produk.php?id=<?php echo $row['id_produk']; ?>" class="edit">
                        Edit
                    </a>

                    <a href="hapus_produk.php?id=<?php echo $row['id_produk']; ?>" 
                    class="hapus"
                    onclick="return confirm('Yakin hapus produk?')">

                        Hapus

                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</main>

<footer>

    <p>© 2026 Toko Bunga - Halaman Petugas</p>

</footer>

</body>
</html>