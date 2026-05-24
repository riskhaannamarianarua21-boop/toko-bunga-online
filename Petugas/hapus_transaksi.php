<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$id_transaksi = $_GET['id'];

mysqli_query($conn,
"DELETE FROM detail_transaksi
WHERE id_transaksi='$id_transaksi'");

mysqli_query($conn,
"DELETE FROM transaksi
WHERE id_transaksi='$id_transaksi'");

echo "
<script>
    alert('Transaksi berhasil dihapus');
    location.href='data_transaksi.php';
</script>
";
?>