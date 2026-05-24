<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$id_transaksi = $_GET['id'];

$transaksi = mysqli_query($conn,

"SELECT * FROM transaksi
JOIN pelanggan
ON transaksi.id_pelanggan = pelanggan.id_pelanggan

WHERE transaksi.id_transaksi='$id_transaksi'");

$data = mysqli_fetch_assoc($transaksi);

$detail = mysqli_query($conn,

"SELECT * FROM detail_transaksi
JOIN produk
ON detail_transaksi.id_produk = produk.id_produk

WHERE detail_transaksi.id_transaksi='$id_transaksi'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>

    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>

    <div class="logo">

        <div class="flower">✿</div>

        <div>
            <h2>Detail Transaksi</h2>
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

    <h1>Detail Pesanan Pelanggan</h1>

    <p>
        Informasi lengkap transaksi pelanggan.
    </p>

</section>

<main>

    <div class="detail-box">

        <div class="info-box">

            <h2>Informasi Pelanggan</h2>

            <p>
                <b>Nama :</b>
                <?php echo $data['nama_pelanggan']; ?>
            </p>

            <p>
                <b>Tanggal :</b>
                <?php echo $data['tanggal']; ?>
            </p>

            <p>
                <b>Status :</b>

                <span class="status">
                    <?php echo $data['status']; ?>
                </span>
            </p>

        </div>

        <div class="table-box">

            <h2>Produk Yang Dibeli</h2>

            <table>

                <tr>

                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>

                </tr>

                <?php
                $no = 1;

                while($row = mysqli_fetch_assoc($detail)){
                ?>

                <tr>

                    <td>
                        <?php echo $no++; ?>
                    </td>

                    <td>
                        <?php echo $row['nama_produk']; ?>
                    </td>

                    <td>
                        Rp <?php echo number_format($row['harga'],0,',','.'); ?>
                    </td>

                    <td>
                        <?php echo $row['qty']; ?>
                    </td>

                    <td>
                        Rp <?php echo number_format($row['subtotal'],0,',','.'); ?>
                    </td>

                </tr>

                <?php } ?>

                <tr class="total-row">

                    <td colspan="4">
                        Total Pembayaran
                    </td>

                    <td>
                        Rp <?php echo number_format($data['total'],0,',','.'); ?>
                    </td>

                </tr>

            </table>

        </div>

        <div class="btn-box">

            <a href="data_transaksi.php" class="btn-kembali">
                Kembali
            </a>

            <a href="ubah_status.php?id=<?php echo $data['id_transaksi']; ?>" 
            class="btn-status">

                Ubah Status

            </a>

        </div>

    </div>

</main>

<footer>

    <p>© 2026 Toko Bunga - Halaman Petugas</p>

</footer>

</body>
</html>