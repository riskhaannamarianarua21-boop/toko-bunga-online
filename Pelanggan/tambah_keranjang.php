<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];
$id_produk = $_POST['id_produk'];
$qty = $_POST['qty'];

$cek = mysqli_query($conn,
"SELECT * FROM keranjang
WHERE id_pelanggan='$id_pelanggan'
AND id_produk='$id_produk'");

if(mysqli_num_rows($cek) > 0){

    mysqli_query($conn,
    "UPDATE keranjang
    SET qty = qty + '$qty'
    WHERE id_pelanggan='$id_pelanggan'
    AND id_produk='$id_produk'");

}else{

    mysqli_query($conn,
    "INSERT INTO keranjang
    (id_pelanggan, id_produk, qty)

    VALUES

    ('$id_pelanggan','$id_produk','$qty')");
}

echo "
<script>
alert('Produk berhasil ditambahkan ke keranjang');
location.href='keranjang.php';
</script>
";
?>