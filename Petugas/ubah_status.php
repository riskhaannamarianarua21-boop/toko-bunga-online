<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$id_transaksi = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM transaksi
WHERE id_transaksi='$id_transaksi'");

$data = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $status = $_POST['status'];

    $update = mysqli_query($conn,

    "UPDATE transaksi SET
    status='$status'

    WHERE id_transaksi='$id_transaksi'");

    if($update){

        echo "
        <script>
            alert('Status transaksi berhasil diubah');
            location.href='data_transaksi.php';
        </script>
        ";

    }else{

        echo "
        <script>
            alert('Gagal mengubah status');
        </script>
        ";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Status</title>

    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>

    <div class="logo">

        <div class="flower">✿</div>

        <div>
            <h2>Ubah Status</h2>
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

    <h1>Update Status Pesanan</h1>

    <p>
        Kelola status transaksi pelanggan.
    </p>

</section>

<main>

    <div class="form-box">

        <form method="POST">

            <label>ID Transaksi</label>

            <input type="text"
            value="<?php echo $data['id_transaksi']; ?>"
            readonly>

            <label>Status Saat Ini</label>

            <input type="text"
            value="<?php echo $data['status']; ?>"
            readonly>

            <label>Ubah Status</label>

            <select name="status" required>

                <option value="">
                    -- Pilih Status --
                </option>

                <option value="Menunggu Pembayaran">
                    Menunggu Pembayaran
                </option>

                <option value="Diproses">
                    Diproses
                </option>

                <option value="Dikirim">
                    Dikirim
                </option>

                <option value="Selesai">
                    Selesai
                </option>

            </select>

            <button type="submit"
            name="update"
            class="btn-simpan">

                Simpan Status

            </button>

        </form>

    </div>

</main>

<footer>

    <p>© 2026 Toko Bunga - Halaman Petugas</p>

</footer>

</body>
</html>