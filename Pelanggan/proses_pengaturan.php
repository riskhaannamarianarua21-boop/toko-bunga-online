<?php
session_start();
include "../koneksi.php";

/** @var mysqli $conn */

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];

$nama_pelanggan = $_POST['nama_pelanggan'];
$username = $_POST['username'];
$alamat = $_POST['alamat'];
$telephone = $_POST['telephone'];
$password = $_POST['password'];

if($password != ""){
    mysqli_query($conn, "UPDATE pelanggan SET 
        nama_pelanggan='$nama_pelanggan',
        username='$username',
        alamat='$alamat',
        telephone='$telephone',
        password='$password'
        WHERE id_pelanggan='$id_pelanggan'");
}else{
    mysqli_query($conn, "UPDATE pelanggan SET 
        nama_pelanggan='$nama_pelanggan',
        username='$username',
        alamat='$alamat',
        telephone='$telephone'
        WHERE id_pelanggan='$id_pelanggan'");
}

$_SESSION['nama_pelanggan'] = $nama_pelanggan;

echo "
<script>
    alert('Data akun berhasil diperbarui');
    location.href='pengaturan.php';
</script>
";
?>