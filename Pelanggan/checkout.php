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

$total = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
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
    <h1>Checkout Pesanan</h1>
    <p>Periksa pesanan Anda sebelum melakukan checkout.</p>
</section>

<main>
    <div class="checkout-box">

        <h2>Ringkasan Pesanan</h2>

        <table>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($query)){ 
                $subtotal = $row['harga'] * $row['qty'];
                $total += $subtotal;
            ?>

            <tr>
                <td><?php echo $row['nama_produk']; ?></td>
                <td>Rp <?php echo number_format($row['harga'],0,',','.'); ?></td>
                <td><?php echo $row['qty']; ?></td>
                <td>Rp <?php echo number_format($subtotal,0,',','.'); ?></td>
            </tr>

            <?php } ?>

            <tr class="total-row">
                <td colspan="3">Total Bayar</td>
                <td>Rp <?php echo number_format($total,0,',','.'); ?></td>
            </tr>
        </table>

        <div class="checkout-wa">

    <h3>Checkout Pesanan</h3>

    <p>
        Klik tombol di bawah untuk melanjutkan pesanan melalui WhatsApp admin.
    </p>

    <a href="https://wa.me/6285344119767?text=Halo Admin,%20saya%20<?php echo $_SESSION['nama_pelanggan']; ?>%20ingin%20checkout%20pesanan%20bunga.%20Total%20belanja%20saya%20Rp<?php echo number_format($total,0,',','.'); ?>"
    class="btn-checkout"
    target="_blank">

        Checkout via WhatsApp

    </a>

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