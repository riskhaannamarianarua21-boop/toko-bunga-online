<?php
session_start();
include '../koneksi.php';

$totalProduk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM produk"));
$totalPelanggan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pelanggan"));
$totalTransaksi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM transaksi"));
$totalPendapatan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total) AS total FROM transaksi WHERE status='Selesai'"));

$transaksiTerbaru = mysqli_query($conn, "
    SELECT transaksi.*, nama_pelanggan 
    FROM transaksi 
    LEFT JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
    ORDER BY transaksi.id_transaksi DESC 
    LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Petugas</title>
    
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="ico/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="ico/favicon-16x16.png">
    <link rel="manifest" href="ico/site.webmanifest">

<style>

    /* TABLET */
@media (max-width: 768px){

    body{
        display:block;
    }

    .sidebar{
        width:100%;
        min-height:auto;
        position:relative;
        padding:15px 0;
    }

    .sidebar h2{
        margin-bottom:15px;
    }

    .sidebar a{
        text-align:center;
        padding:12px;
        border-left:none;
    }

    .main{
        width:100%;
        margin-left:0;
        padding:20px;
    }

    .cards{
        grid-template-columns:repeat(2,1fr);
    }

    .content{
        grid-template-columns:1fr;
    }

    .chart{
        overflow-x:auto;
    }
}

/* MOBILE */
@media (max-width: 480px){

    .sidebar{
        text-align:center;
    }

    .sidebar h2{
        font-size:22px;
    }

    .sidebar a{
        font-size:14px;
        padding:10px;
    }

    .main{
        padding:15px;
    }

    .topbar{
        padding:20px;
        text-align:center;
    }

    .topbar h1{
        font-size:24px;
    }

    .topbar p{
        font-size:14px;
    }

    .cards{
        grid-template-columns:1fr;
    }

    .card{
        padding:20px;
    }

    .card h2{
        font-size:24px;
    }

    .content{
        grid-template-columns:1fr;
    }

    .chart{
        height:220px;
        gap:10px;
        overflow-x:auto;
    }

    .bar{
        width:35px;
    }

    .box{
        padding:15px;
    }

    .menu a{
        font-size:14px;
    }

    /* TABEL RESPONSIVE */
    .box{
        overflow-x:auto;
    }

    table{
        min-width:700px;
    }

    th,
    td{
        padding:10px;
        font-size:13px;
    }

    .btn{
        padding:6px 10px;
        font-size:12px;
    }
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#fff6fa;
    display:flex;
    color:#333;
}

/* SIDEBAR */

.sidebar{
    width:250px;
    min-height:100vh;
    background:#9c1456;
    position:fixed;
    left:0;
    top:0;
    padding-top:25px;
    box-shadow:5px 0 20px rgba(0,0,0,0.08);
}

.sidebar h2{
    color:white;
    text-align:center;
    margin-bottom:40px;
    font-size:26px;
}

.sidebar a{
    display:block;
    padding:15px 30px;
    text-decoration:none;
    color:#f8d7e6;
    font-weight:600;
    transition:.3s;
}

.sidebar a:hover,
.sidebar .active{
    background:#c2185b;
    color:white;
    border-left:5px solid white;
}

/* MAIN */

.main{
    width:calc(100% - 250px);
    margin-left:250px;
    padding:30px;
}

/* TOPBAR */

.topbar{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 8px 25px rgba(194,24,91,.08);
    margin-bottom:25px;
}

.topbar h1{
    color:#c2185b;
    font-size:32px;
}

.topbar p{
    color:#777;
    margin-top:5px;
}

/* CARD */

.cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:25px;
}

.card{
    padding:25px;
    border-radius:20px;
    color:white;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

.card h3{
    font-size:16px;
    margin-bottom:10px;
}

.card h2{
    font-size:32px;
    margin-bottom:10px;
}

.card span{
    font-size:13px;
}

/* WARNA CARD */

.green{
    background:linear-gradient(135deg,#c2185b,#d81b60);
}

.purple{
    background:linear-gradient(135deg,#d81b60,#e91e63);
}

.blue{
    background:linear-gradient(135deg,#ec407a,#f06292);
}

.orange{
    background:linear-gradient(135deg,#f48fb1,#f8bbd0);
}

/* CONTENT */

.content{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:25px;
    margin-bottom:25px;
}

.box{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 8px 25px rgba(194,24,91,.08);
}

.box h3{
    color:#c2185b;
    margin-bottom:20px;
}

/* CHART */

.chart{
    height:260px;
    display:flex;
    align-items:flex-end;
    gap:20px;
    border-left:2px solid #eee;
    border-bottom:2px solid #eee;
    padding:20px;
}

.bar{
    width:55px;
    background:linear-gradient(#c2185b,#f06292);
    border-radius:10px 10px 0 0;
    position:relative;
}

.bar span{
    position:absolute;
    bottom:-30px;
    left:10px;
    font-size:12px;
}

/* MENU CEPAT */

.menu a{
    display:block;
    padding:15px;
    margin-bottom:12px;
    text-decoration:none;
    background:#fff0f6;
    color:#c2185b;
    border-radius:12px;
    font-weight:600;
    transition:.3s;
}

.menu a:hover{
    background:#c2185b;
    color:white;
}

/* TABLE */

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#c2185b;
    color:white;
    padding:15px;
}

td{
    padding:15px;
    border-bottom:1px solid #eee;
}

tr:hover{
    background:#fff5f8;
}

.status{
    background:#ffe0ec;
    color:#c2185b;
    padding:8px 14px;
    border-radius:30px;
    font-size:13px;
    font-weight:bold;
}

.btn{
    background:#c2185b;
    color:white;
    padding:8px 15px;
    text-decoration:none;
    border-radius:8px;
}

.btn:hover{
    background:#9c1456;
}

/* RESPONSIVE */

@media(max-width:1000px){

    .cards{
        grid-template-columns:repeat(2,1fr);
    }

    .content{
        grid-template-columns:1fr;
    }

}

</style>
</head>

<body>

<div class="sidebar">
    <h2>🌸 FlowerAdmin</h2>
    <a href="index.php" class="active">Dashboard</a>
    <a href="data_produk.php">Produk</a>
    <a href="data_pelanggan.php">Pelanggan</a>
    <a href="data_transaksi.php">Transaksi</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="main">

    <div class="topbar">
        <h1>Dashboard Petugas</h1>
        <p>Toko Bunga Online</p>
    </div>

    <div class="cards">
        <div class="card green">
            <h3>Total Produk</h3>
            <h2><?= $totalProduk['total']; ?></h2>
            <span>Data produk tersedia</span>
        </div>

        <div class="card purple">
            <h3>Total Pelanggan</h3>
            <h2><?= $totalPelanggan['total']; ?></h2>
            <span>Pelanggan terdaftar</span>
        </div>

        <div class="card blue">
            <h3>Total Transaksi</h3>
            <h2><?= $totalTransaksi['total']; ?></h2>
            <span>Transaksi masuk</span>
        </div>

        <div class="card orange">
            <h3>Pendapatan</h3>
            <h2>Rp <?= number_format($totalPendapatan['total'] ?? 0, 0, ',', '.'); ?></h2>
            <span>Transaksi selesai</span>
        </div>
    </div>

    <div class="content">
        <div class="box">
            <h3>Ringkasan Penjualan</h3>
            <div class="chart">
                <div class="bar" style="height:35%;"><span>Jan</span></div>
                <div class="bar" style="height:50%;"><span>Feb</span></div>
                <div class="bar" style="height:40%;"><span>Mar</span></div>
                <div class="bar" style="height:70%;"><span>Apr</span></div>
                <div class="bar" style="height:60%;"><span>Mei</span></div>
                <div class="bar" style="height:85%;"><span>Jun</span></div>
            </div>
        </div>

        <div class="box menu">
            <h3>Menu Cepat</h3>
            <a href="tambah_produk.php">+ Tambah Produk</a>
            <a href="data_produk.php">Kelola Produk</a>
            <a href="data_pelanggan.php">Data Pelanggan</a>
            <a href="data_transaksi.php">Data Transaksi</a>
        </div>
    </div>

    <div class="box">
        <h3>Transaksi Terbaru</h3>

        <table>
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($transaksiTerbaru)) { ?>
            <tr>
                <td><?= $row['id_transaksi']; ?></td>
                <td><?= $row['nama'] ?? 'Pelanggan'; ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td>Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                <td><span class="status"><?= $row['status']; ?></span></td>
                <td>
                    <a class="btn" href="detail_transaksi.php?id=<?= $row['id_transaksi']; ?>">Detail</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

</body>
</html>