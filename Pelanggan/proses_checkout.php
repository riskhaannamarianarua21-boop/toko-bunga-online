<?php
session_start();
include "../koneksi.php";

/** @var mysqli $conn */

if(!isset($_SESSION['status_login'])){
    header("location:../login.php");
    exit;
}

$id_pelanggan = $_SESSION['id_pelanggan'];
$tanggal = date("Y-m-d");

$keranjang = mysqli_query($conn,
"SELECT * FROM keranjang
JOIN produk ON keranjang.id_produk = produk.id_produk
WHERE keranjang.id_pelanggan='$id_pelanggan'");

if(mysqli_num_rows($keranjang) == 0){
    echo "<script>
        alert('Keranjang masih kosong');
        location.href='produk.php';
    </script>";
    exit;
}

$total = 0;

while($row = mysqli_fetch_assoc($keranjang)){
    $total += $row['harga'] * $row['qty'];
}

mysqli_query($conn,
"INSERT INTO transaksi (id_pelanggan, tanggal, total, status)
VALUES ('$id_pelanggan', '$tanggal', '$total', 'Menunggu Pembayaran')");

$id_transaksi = mysqli_insert_id($conn);

$keranjang2 = mysqli_query($conn,
"SELECT * FROM keranjang
JOIN produk ON keranjang.id_produk = produk.id_produk
WHERE keranjang.id_pelanggan='$id_pelanggan'");

while($row = mysqli_fetch_assoc($keranjang2)){
    $subtotal = $row['harga'] * $row['qty'];

    mysqli_query($conn,
    "INSERT INTO detail_transaksi
    (id_transaksi, id_produk, qty, subtotal)
    VALUES
    ('$id_transaksi', '".$row['id_produk']."', '".$row['qty']."', '$subtotal')");
}

mysqli_query($conn,
"DELETE FROM keranjang WHERE id_pelanggan='$id_pelanggan'");

echo "<script>
    alert('Checkout berhasil');
    location.href='produk.php';
</script>";
?>