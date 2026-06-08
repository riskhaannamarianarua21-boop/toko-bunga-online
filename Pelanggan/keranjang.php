<?php
session_start();
include "../koneksi.php";

/** @var mysqli $conn */

if (!isset($_SESSION['status_login'])) {
    header("location:../login.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM keranjang
JOIN produk ON keranjang.id_produk = produk.id_produk
WHERE keranjang.id_pelanggan='$id_pelanggan'"
);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="keranjang.css">
        
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
            <a href="keranjang.php" class="cart-icon active">🛒</a>
            <a href="index.php">Beranda</a>
            <a href="produk.php">Produk</a>
            <a href="checkout.php" id="navCheckout">Checkout</a>
            <a href="pengaturan.php" class="settings-icon">⚙️</a>
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
                    <th>Pilih</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>

                <?php
                $no = 1;
                $total = 0;

                while ($row = mysqli_fetch_assoc($query)) {
                    $subtotal = $row['harga'] * $row['qty'];
                    $total += $subtotal;
                ?>

                    <tr>
                        <td>
                            <input
                                type="checkbox"
                                class="check-item"
                                data-id="<?php echo $row['id_keranjang']; ?>"
                                data-subtotal="<?php echo $subtotal; ?>">
                        </td>
                        <td class="produk-nama"><?php echo $row['nama_produk']; ?></td>
                        <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $row['qty']; ?></td>
                        <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                        <td>
                            <a href="hapus_keranjang.php?id=<?php echo $row['id_keranjang']; ?>"
                                class="btn-hapus"
                                onclick="return confirm('Yakin ingin menghapus produk ini dari keranjang?')">
                                Hapus
                            </a>
                        </td>
                    </tr>

                <?php } ?>

                <tr class="total-row">
                    <td colspan="5" class="label-total">Total</td>
                    <td class="harga-total" id="totalHarga">
                        Rp 0
                    </td>
                </tr>
            </table>

            <div class="cart-action">
                <a href="produk.php" class="btn-secondary">Lanjut Belanja</a>
                <a href="checkout.php" class="btn-primary" id="btnCheckout">Checkout</a>
            </div>

        </div>
    </main>

    <script>
        const checkbox = document.querySelectorAll('.check-item');
        const totalHarga = document.getElementById('totalHarga');
        const navCheckout = document.getElementById('navCheckout');

        let selectedItems = JSON.parse(localStorage.getItem('selectedKeranjang')) || [];

        checkbox.forEach(item => {
            if (selectedItems.includes(item.dataset.id)) {
                item.checked = true;
            }
        });

        function hitungTotal() {
            let total = 0;
            selectedItems = [];

            checkbox.forEach(item => {
                if (item.checked) {
                    total += parseInt(item.dataset.subtotal);
                    selectedItems.push(item.dataset.id);
                }
            });

            localStorage.setItem('selectedKeranjang', JSON.stringify(selectedItems));

            totalHarga.innerText = 'Rp ' + total.toLocaleString('id-ID');

            if (selectedItems.length > 0) {
                btnCheckout.href = 'checkout.php?items=' + selectedItems.join(',');
                navCheckout.href = 'checkout.php?items=' + selectedItems.join(',');
            } else {
                btnCheckout.href = 'checkout.php';
                navCheckout.href = 'checkout.php';
            }
        }

        checkbox.forEach(item => {
            item.addEventListener('change', hitungTotal);
        });

        hitungTotal();
    </script>

    <footer>
        <p>📍 Jl. Pulau Sumetera(Bahu)</p>
        <p>📞 085344119767</p>
        <p>© 2026 Toko Bunga</p>
    </footer>

</body>

</html>