<?php
session_start();
include "../koneksi.php";

/** @var mysqli $conn */

if (!isset($_SESSION['status_login'])) {
    header("location:../login.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];

$items = isset($_GET['items']) ? $_GET['items'] : '';
$items = mysqli_real_escape_string($conn, $items);

$total = 0;

if ($items != '') {
    $query = mysqli_query(
        $conn,
        "SELECT * FROM keranjang
    JOIN produk ON keranjang.id_produk = produk.id_produk
    WHERE keranjang.id_pelanggan='$id_pelanggan'
    AND keranjang.id_keranjang IN ($items)"
    );
} else {
    $query = null;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
        
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
            <a href="index.php">Beranda</a>
            <a href="produk.php">Produk</a>
            <a href="checkout.php" class="active">Checkout</a>
            <a href="pengaturan.php" class="settings-icon">⚙️</a>
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

                <?php if ($query) { ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) {
                        $subtotal = $row['harga'] * $row['qty'];
                        $total += $subtotal;
                    ?>

                        <tr>
                            <td><?php echo $row['nama_produk']; ?></td>
                            <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td><?php echo $row['qty']; ?></td>
                            <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                        </tr>

                    <?php } ?>
                <?php } ?>

                <tr class="total-row">
                    <td colspan="3">Total Bayar</td>
                    <td>Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                </tr>
            </table>

           <div class="checkout-wa">

    <h3>Checkout Pesanan</h3>

    <p>
        Klik tombol di bawah untuk menyimpan transaksi.
    </p>

    <a href="proses_checkout.php"
        class="btn-checkout">

        Checkout Sekarang

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