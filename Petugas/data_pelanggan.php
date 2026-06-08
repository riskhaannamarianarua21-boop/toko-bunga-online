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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    
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
    background:#fff;
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
    border-radius:50%;
    background:#c2185b;
    color:white;
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
    font-size:50px;
    margin-bottom:10px;
}

.hero p{
    color:#555;
    font-size:18px;
}

.table-box{
    width:90%;
    margin:40px auto;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
    overflow-x:auto;
}

.table-header{
    margin-bottom:25px;
}

.table-header h2{
    color:#c2185b;
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
    background:#fff4f8;
}

tr:hover{
    background:#ffeef5;
}

.hapus{
    background:#f44336;
    color:white;
    text-decoration:none;
    padding:10px 18px;
    border-radius:8px;
    display:inline-block;
    font-weight:bold;
}

.hapus:hover{
    background:#d32f2f;
}

footer{
    text-align:center;
    padding:25px;
    color:#666;
    margin-top:30px;
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
        min-width:850px;
    }

    th,
    td{
        padding:10px;
        font-size:13px;
    }

    .hapus{
        display:block;
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
         <script src="assets/js/script.js"></script>
</body>
</html>