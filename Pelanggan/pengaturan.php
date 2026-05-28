<?php
session_start();
include "../koneksi.php";

/** @var mysqli $conn */

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];

$query = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Akun</title>
    <link rel="stylesheet" href="pengaturan.css">
</head>
<body>

<div class="setting-box">
    <h2>Pengaturan Akun</h2>

    <form action="proses_pengaturan.php" method="POST">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_pelanggan" value="<?php echo $data['nama_pelanggan']; ?>" required>

        <label>Username</label>
        <input type="text" name="username" value="<?php echo $data['username']; ?>" required>

        <label>Alamat</label>
        <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" required>

        <label>Nomor Telepon</label>
        <input type="text" name="no_telp" value="<?php echo $data['no_telp']; ?>" required>

        <label>Password Baru</label>
        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin ganti">

        <button type="submit" class="btn-save">Simpan Perubahan</button>
    </form>

    <a href="../logout.php" class="btn-logout">Logout</a>
    <a href="index.php" class="btn-back">Kembali</a>
</div>

</body>
</html>