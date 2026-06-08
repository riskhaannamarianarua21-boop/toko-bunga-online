<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$transaksi = mysqli_query($conn,

"SELECT transaksi.*, pelanggan.nama_pelanggan
FROM transaksi
LEFT JOIN pelanggan
ON transaksi.id_pelanggan = pelanggan.id_pelanggan

ORDER BY transaksi.id_transaksi DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
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
    font-family:Arial, sans-serif;
}

body{
    background:#fff7fb;
    color:#333;
}

header{
    background:#ffffff;
    padding:20px 60px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
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
    align-items:center;
    justify-content:center;
    font-size:25px;
}

.logo h2{
    color:#c2185b;
    font-size:24px;
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
    color:#e53935;
}

.hero{
    background:#f7dfe9;
    text-align:center;
    padding:60px 20px;
}

.hero h1{
    font-size:48px;
    color:#c2185b;
    margin-bottom:10px;
}

.hero p{
    font-size:18px;
    color:#555;
}

main{
    padding:50px 0;
}

.table-box{
    width:90%;
    margin:auto;
    background:white;
    padding:40px;
    border-radius:18px;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
    overflow-x:auto;
}

.table-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.table-header h2{
    color:#c2185b;
    font-size:26px;
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
    font-size:16px;
}

td{
    padding:18px;
    text-align:center;
    vertical-align:middle;
    border-bottom:1px solid #eee;
}

tr:nth-child(even){
    background:#fff2f7;
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

.edit{
    background:#2196f3;
    color:white;
    text-decoration:none;
    padding:10px 16px;
    border-radius:8px;
    margin:4px;
    display:inline-block;
}

.btn-status{
    background:#ff9800;
    color:white;
    text-decoration:none;
    padding:10px 16px;
    border-radius:8px;
    margin:4px;
    display:inline-block;
}

.hapus{
    background:#e53935;
    color:white;
    text-decoration:none;
    padding:10px 16px;
    border-radius:8px;
    margin:4px;
    display:inline-block;
}

footer{
    text-align:center;
    padding:25px;
    color:#666;
    background:white;
    margin-top:40px;
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

    .table-box{
        width:95%;
        padding:20px;
    }

    .table-header{
        flex-direction:column;
        gap:10px;
        text-align:center;
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

    .table-box{
        width:95%;
        padding:15px;
        overflow-x:auto;
    }

    table{
        min-width:900px;
    }

    th,
    td{
        padding:10px;
        font-size:13px;
    }

    .edit,
    .btn-status,
    .hapus{
        display:block;
        margin:5px 0;
        text-align:center;
        font-size:12px;
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
         <script src="assets/js/script.js"></script>

</body>
</html>