<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$id_produk = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM produk WHERE id_produk='$id_produk'");

$data = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    if($_FILES['gambar']['name'] != ""){

        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        move_uploaded_file($tmp,
        "../gambar_produk/".$foto_produk);

        $update = mysqli_query($conn,
        "UPDATE produk SET

        nama_produk='$nama_produk',
        harga='$harga',
        deskripsi='$deskripsi',
        foto_produk='$foto_produk'

        WHERE id_produk='$id_produk'");

    }else{

        $update = mysqli_query($conn,
        "UPDATE produk SET

        nama_produk='$nama_produk',
        harga='$harga',
        deskripsi='$deskripsi'

        WHERE id_produk='$id_produk'");

    }

    if($update){

        echo "
        <script>
            alert('Produk berhasil diupdate');
            location.href='data_produk.php';
        </script>
        ";

    }else{

        echo "
        <script>
            alert('Gagal update produk');
        </script>
        ";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
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
    background:#fff;
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
    justify-content:center;
    align-items:center;
    font-size:24px;
}

.logo h2{
    color:#c2185b;
}

.logo p{
    color:#777;
    font-size:13px;
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
    background:#f8dce8;
    text-align:center;
    padding:60px 20px;
}

.hero h1{
    color:#c2185b;
    font-size:42px;
    margin-bottom:10px;
}

.hero p{
    color:#555;
}

main{
    padding:50px 0;
}

.form-box{
    width:650px;
    max-width:90%;
    margin:auto;
    background:#fff;
    padding:40px;
    border-radius:18px;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

.form-box form{
    display:flex;
    flex-direction:column;
}

.form-box label{
    font-weight:bold;
    margin-top:15px;
    margin-bottom:8px;
    color:#444;
}

.form-box input[type=text],
.form-box input[type=number],
.form-box textarea{
    padding:14px;
    border:1px solid #ddd;
    border-radius:10px;
    font-size:15px;
}

.form-box textarea{
    min-height:120px;
    resize:vertical;
}

.form-box input[type=file]{
    background:#fff2f7;
    padding:12px;
    border-radius:10px;
    border:1px solid #eee;
}

.preview{
    width:220px;
    height:220px;
    object-fit:cover;
    border-radius:15px;
    border:4px solid #f3d3df;
    margin-top:10px;
    margin-bottom:15px;
}

.btn-simpan{
    margin-top:25px;
    padding:15px;
    background:#c2185b;
    color:white;
    border:none;
    border-radius:10px;
    font-size:16px;
    cursor:pointer;
    font-weight:bold;
}

.btn-simpan:hover{
    background:#a3154d;
}

footer{
    text-align:center;
    padding:25px;
    margin-top:40px;
    background:white;
    color:#777;
}

@media screen and (max-width:768px){

    header{
        flex-direction:column;
        gap:15px;
        text-align:center;
        padding:20px;
    }

    nav{
        display:flex;
        justify-content:center;
        gap:15px;
        flex-wrap:wrap;
    }

    nav a{
        margin-left:0;
    }

    .hero h1{
        font-size:34px;
    }

    .form-box{
        width:95%;
        padding:25px;
    }

    .preview{
        width:180px;
        height:180px;
        display:block;
        margin:auto;
    }
}

@media screen and (max-width:480px){

    .logo{
        flex-direction:column;
        text-align:center;
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

    .form-box{
        width:95%;
        padding:20px;
    }

    .preview{
        width:150px;
        height:150px;
    }

    .btn-simpan{
        font-size:14px;
    }
}
</style>
</head>
<body>

<header>

    <div class="logo">

        <div class="flower">✿</div>

        <div>
            <h2>Edit Produk</h2>
            <p>Toko Bunga Online</p>
        </div>

    </div>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="data_produk.php">Produk</a>
        <a href="../logout.php" class="logout">Logout</a>
    </nav>

</header>

<section class="hero">

    <h1>Edit Produk</h1>

    <p>
        Perbarui data produk bunga.
    </p>

</section>

<main>

    <div class="form-box">

        <form method="POST" enctype="multipart/form-data">

            <label>Nama Produk</label>

            <input type="text"
            name="nama_produk"
            value="<?php echo $data['nama_produk']; ?>"
            required>

            <label>Harga Produk</label>

            <input type="number"
            name="harga"
            value="<?php echo $data['harga']; ?>"
            required>

            <label>Deskripsi Produk</label>

            <textarea
            name="deskripsi"
            required><?php echo $data['deskripsi']; ?></textarea>

            <label>Gambar Saat Ini</label>

            <img src="../gambar_produk/<?php echo $data['foto_produk']; ?>" class="preview">

            <label>Upload Gambar Baru</label>

            <input type="file"
            name="gambar">

            <button type="submit"
            name="update"
            class="btn-simpan">

                Update Produk

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