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

if($data){

    $gambar = "../gambar_produk/".$data['gambar'];

    if(file_exists($gambar)){
        unlink($gambar);
    }

    mysqli_query($conn,
    "DELETE FROM produk WHERE id_produk='$id_produk'");

    echo "
    <script>
        alert('Produk berhasil dihapus');
        location.href='data_produk.php';
    </script>
    ";

}else{

    echo "
    <script>
        alert('Produk tidak ditemukan');
        location.href='data_produk.php';
    </script>
    ";

}
?>