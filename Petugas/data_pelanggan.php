<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$pelanggan = mysqli_query($conn,
"SELECT * FROM pelanggan ORDER BY id_pelanggan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pelanggan</title>

    <link rel="stylesheet" href="admin.css">
</head>
<body>

<header>

    <div class="logo">

        <div class="flower">✿</div>

        <div>
            <h2>Data Pelanggan</h2>
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

    <h1>Data Pelanggan</h1>

    <p>
        Daftar pelanggan yang telah melakukan registrasi.
    </p>

</section>

<main>

    <div class="table-box">

        <div class="table-header">

            <h2>
                Total Pelanggan :
                <?php echo mysqli_num_rows($pelanggan); ?>
            </h2>

        </div>

        <table>

            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>Telephone</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;

            while($row = mysqli_fetch_assoc($pelanggan)){
            ?>

            <tr>

                <td>
                    <?php echo $no++; ?>
                </td>

                <td>
                    <?php echo $row['nama_pelanggan']; ?>
                </td>

                <td>
                    <?php echo $row['username']; ?>
                </td>

                <td>
                    <?php echo $row['alamat']; ?>
                </td>

                <td>
                    <?php echo $row['telephone']; ?>
                </td>

                <td>

                    <a href="hapus_pelanggan.php?id=<?php echo $row['id_pelanggan']; ?>"
                    class="hapus"
                    onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">

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