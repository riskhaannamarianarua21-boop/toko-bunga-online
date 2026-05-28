<?php
session_start();
include "../koneksi.php";

/** @var mysqli $conn */

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$id_keranjang = $_GET['id'];
$id_pelanggan = $_SESSION['id_pelanggan'];

mysqli_query($conn, 
"DELETE FROM keranjang 
WHERE id_keranjang='$id_keranjang' 
AND id_pelanggan='$id_pelanggan'");

echo "
<script>
    alert('Produk berhasil dihapus dari keranjang');
    location.href='keranjang.php';
</script>
";
?>