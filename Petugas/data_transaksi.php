<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$transaksi = mysqli_query($conn,

"SELECT * FROM transaksi
JOIN pelanggan
ON transaksi.id_pelanggan = pelanggan.id_pelanggan

ORDER BY id_transaksi DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Transaksi</title>

    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>

    <div class="logo">

        <div class="flower">✿</div>

        <div>
            <h2>Data Transaksi</h2>
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

    <h1>Data Transaksi Pelanggan</h1>

    <p>
        Kelola pesanan pelanggan toko bunga.
    </p>

</section>

<main>

    <div class="table-box">

        <div class="table-header">

            <h2>
                Total Transaksi :
                <?php echo mysqli_num_rows($transaksi); ?>
            </h2>

        </div>

        <table>

            <tr>

                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>

            <?php
            $no = 1;

            while($row = mysqli_fetch_assoc($transaksi)){
            ?>

            <tr>

                <td>
                    <?php echo $no++; ?>
                </td>

                <td>
                    <?php echo $row['nama_pelanggan']; ?>
                </td>

                <td>
                    <?php echo $row['tanggal']; ?>
                </td>

                <td>
                    Rp <?php echo number_format($row['total'],0,',','.'); ?>
                </td>

                <td>

                    <span class="status">
                        <?php echo $row['status']; ?>
                    </span>

                </td>

                <td>

    <a href="detail_transaksi.php?id=<?php echo $row['id_transaksi']; ?>" 
    class="edit">

        Detail

    </a>

    <a href="ubah_status.php?id=<?php echo $row['id_transaksi']; ?>" 
    class="btn-status">

        Status

    </a>

    <a href="hapus_transaksi.php?id=<?php echo $row['id_transaksi']; ?>" 
    class="hapus"
    onclick="return confirm('Yakin ingin menghapus transaksi?')">

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