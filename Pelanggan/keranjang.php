<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];

$query = mysqli_query($conn,
"SELECT * FROM keranjang
JOIN produk ON keranjang.id_produk = produk.id_produk
WHERE keranjang.id_pelanggan='$id_pelanggan'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="keranjang.css">
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
        <a href="keranjang.php">Keranjang</a>
        <a href="../logout.php" class="logout">Logout</a>
    </nav>
</header>

<section class="hero">
    <h1>Keranjang Belanja</h1>
    <p>Periksa kembali produk bunga pilihan Anda.</p>
</section>

<main>
    <div class="cart-box">

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
            $total = 0;

            while($row = mysqli_fetch_assoc($query)){
                $subtotal = $row['harga'] * $row['qty'];
                $total += $subtotal;
            ?>

            <tr>
                <td><?php echo $no++; ?></td>
                <td class="produk-nama"><?php echo $row['nama_produk']; ?></td>
                <td>Rp <?php echo number_format($row['harga'],0,',','.'); ?></td>
                <td><?php echo $row['qty']; ?></td>
                <td>Rp <?php echo number_format($subtotal,0,',','.'); ?></td>
            </tr>

            <?php } ?>

            <tr class="total-row">
                <td colspan="4">Total</td>
                <td>Rp <?php echo number_format($total,0,',','.'); ?></td>
            </tr>
        </table>

        <div class="cart-action">
            <a href="produk.php" class="btn-secondary">Lanjut Belanja</a>
            <a href="checkout.php" class="btn-primary">Checkout</a>
        </div>

    </div>
</main>

<footer>
    <p>📍 Jl. Pulau Sumetera(Bahu)</p>
    <p>📞 085344119767</p>
    <p>© 2026 Toko Bunga</p>
</footer>

</body>
</html>