<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$produk = mysqli_query($conn,
"SELECT * FROM produk ORDER BY id_produk DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
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
            width:85%;
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

        .btn-tambah{
            background:#c2185b;
            color:white;
            padding:14px 24px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
        }

        .btn-tambah:hover{
            background:#a3154d;
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
            padding:20px;
            text-align:center;
            vertical-align:middle;
            border-bottom:1px solid #eee;
        }

        tr:nth-child(even){
            background:#fff2f7;
        }

        .gambar{
            width:120px;
            height:120px;
            object-fit:cover;
            border-radius:12px;
            display:block;
            margin:auto;
        }

        .edit{
            background:#2196f3;
            color:white;
            text-decoration:none;
            padding:10px 18px;
            border-radius:8px;
            margin-right:6px;
            display:inline-block;
        }

        .hapus{
            background:#e53935;
            color:white;
            text-decoration:none;
            padding:10px 18px;
            border-radius:8px;
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
        gap:15px;
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
        min-width:700px;
    }

    th,
    td{
        padding:10px;
        font-size:13px;
    }

    .gambar{
        width:80px;
        height:80px;
    }

    .edit,
    .hapus{
        display:block;
        margin:5px 0;
        text-align:center;
        font-size:12px;
    }

    .btn-tambah{
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
            <h2>Data Produk</h2>
            <p>Toko Bunga Online</p>
        </div>

    </div>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="data_produk.php">Produk</a>
        <a href="data_transaksi.php">Transaksi</a>
        <a href="../logout.php" class="logout">Logout</a>
    </nav>

</header>

<section class="hero">

    <h1>Kelola Produk Bunga</h1>

    <p>
        Tambah, edit, dan hapus produk bunga.
    </p>

</section>

<main>

    <div class="table-box">

        <div class="table-header">

            <h2>Daftar Produk</h2>

            <a href="tambah_produk.php" class="btn-tambah">
                + Tambah Produk
            </a>

        </div>

        <table>

            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;

            while($row = mysqli_fetch_assoc($produk)){
            ?>

            <tr>

                <td><?php echo $no++; ?></td>

                <td>
                    <img src="../gambar_produk/<?php echo $row['foto_produk']; ?>" class="gambar">
                </td>

                <td>
                    <?php echo $row['nama_produk']; ?>
                </td>

                <td>
                    Rp <?php echo number_format($row['harga'],0,',','.'); ?>
                </td>

                <td>

                    <a href="edit_produk.php?id=<?php echo $row['id_produk']; ?>" class="edit">
                        Edit
                    </a>

                    <a href="hapus_produk.php?id=<?php echo $row['id_produk']; ?>" 
                    class="hapus"
                    onclick="return confirm('Yakin hapus produk?')">

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