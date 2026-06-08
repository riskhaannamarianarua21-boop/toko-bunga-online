<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$id_transaksi = $_GET['id'];

$transaksi = mysqli_query($conn,

"SELECT transaksi.*, pelanggan.nama_pelanggan
FROM transaksi
LEFT JOIN pelanggan
ON transaksi.id_pelanggan = pelanggan.id_pelanggan

WHERE transaksi.id_transaksi='$id_transaksi'");

$data = mysqli_fetch_assoc($transaksi);
if(!$data){
    die("Data transaksi tidak ditemukan");
}

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="ico/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="ico/favicon-16x16.png">
    <link rel="manifest" href="ico/site.webmanifest">

    <style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:#fff7fb;
    color:#333;
}

header{
    background:white;
    padding:20px 60px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.logo{
    display:flex;
    align-items:center;
    gap:15px;
}

.flower{
    width:50px;
    height:50px;
    background:#c2185b;
    color:white;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:24px;
}

.logo h2{
    color:#c2185b;
}

.logo p{
    color:#666;
    font-size:14px;
}

nav a{
    text-decoration:none;
    color:#555;
    margin-left:20px;
    font-weight:bold;
}

nav a:hover{
    color:#c2185b;
}

.logout{
    color:red;
}

.hero{
    background:#f7dfe9;
    text-align:center;
    padding:60px 20px;
}

.hero h1{
    color:#c2185b;
    font-size:48px;
    margin-bottom:10px;
}

.hero p{
    color:#555;
    font-size:18px;
}

.detail-box{
    width:85%;
    margin:40px auto;
}

.info-box,
.table-box{
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
    margin-bottom:30px;
}

.info-box h2,
.table-box h2{
    color:#c2185b;
    margin-bottom:20px;
}

.info-box p{
    margin-bottom:12px;
    font-size:16px;
}

.status{
    background:#ffe5ef;
    color:#c2185b;
    padding:8px 15px;
    border-radius:20px;
    font-size:14px;
    font-weight:bold;
    display:inline-block;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#c2185b;
    color:white;
    padding:18px;
    text-align:center;
}

td{
    padding:18px;
    text-align:center;
    border-bottom:1px solid #eee;
}

tr:nth-child(even){
    background:#fff2f7;
}

.total-row{
    background:#f7dfe9 !important;
    font-weight:bold;
    color:#c2185b;
}

.btn-box{
    display:flex;
    justify-content:flex-end;
    gap:12px;
}

.btn-kembali{
    background:#777;
    color:white;
    text-decoration:none;
    padding:12px 20px;
    border-radius:10px;
    font-weight:bold;
}

.btn-status{
    background:#ff9800;
    color:white;
    text-decoration:none;
    padding:12px 20px;
    border-radius:10px;
    font-weight:bold;
}

footer{
    text-align:center;
    padding:25px;
    color:#666;
}

/* =========================
   RESPONSIVE TABLET
========================= */
@media screen and (max-width:768px){

    header{
        flex-direction:column;
        gap:15px;
        text-align:center;
        padding:20px;
    }

    .logo{
        justify-content:center;
    }

    nav{
        display:flex;
        flex-wrap:wrap;
        justify-content:center;
        gap:15px;
    }

    nav a{
        margin-left:0;
    }

    .hero{
        padding:40px 20px;
    }

    .hero h1{
        font-size:36px;
    }

    .hero p{
        font-size:16px;
    }

    .detail-box{
        width:95%;
    }

    .info-box,
    .table-box{
        padding:20px;
    }

    .btn-box{
        justify-content:center;
        flex-wrap:wrap;
    }
}

/* =========================
   RESPONSIVE MOBILE
========================= */
@media screen and (max-width:480px){

    header{
        padding:15px;
    }

    .logo{
        flex-direction:column;
        text-align:center;
        gap:10px;
    }

    .flower{
        width:45px;
        height:45px;
        font-size:20px;
    }

    .logo h2{
        font-size:22px;
    }

    .logo p{
        font-size:13px;
    }

    nav{
        flex-direction:column;
        gap:10px;
    }

    .hero{
        padding:30px 15px;
    }

    .hero h1{
        font-size:28px;
    }

    .hero p{
        font-size:14px;
    }

    .detail-box{
        width:95%;
    }

    .info-box,
    .table-box{
        padding:15px;
    }

    .info-box p{
        font-size:14px;
    }

    /* TABEL RESPONSIVE */
    .table-box{
        overflow-x:auto;
    }

    table{
        min-width:650px;
    }

    th,
    td{
        padding:10px;
        font-size:13px;
    }

    .btn-box{
        flex-direction:column;
    }

    .btn-kembali,
    .btn-status{
        width:100%;
        text-align:center;
    }

    footer{
        font-size:13px;
        padding:15px;
    }
}
</style>
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
         <script src="assets/js/script.js"></script>
</body>
</html>