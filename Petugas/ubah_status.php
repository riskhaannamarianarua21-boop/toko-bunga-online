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
    font-size:48px;
    margin-bottom:10px;
}

.hero p{
    color:#555;
}

.form-box{
    width:500px;
    max-width:90%;
    margin:40px auto;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.form-box label{
    display:block;
    margin-top:15px;
    margin-bottom:8px;
    font-weight:bold;
    color:#444;
}

.form-box input,
.form-box select{
    width:100%;
    padding:12px;
    border:1px solid #ddd;
    border-radius:10px;
    font-size:15px;
}

.btn-simpan{
    width:100%;
    margin-top:25px;
    padding:14px;
    border:none;
    border-radius:10px;
    background:#c2185b;
    color:white;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

.btn-simpan:hover{
    background:#a3154d;
}

footer{
    text-align:center;
    padding:25px;
    margin-top:40px;
    color:#666;
}
</style>
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
        <script src="assets/js/script.js"></script>

</body>
</html>