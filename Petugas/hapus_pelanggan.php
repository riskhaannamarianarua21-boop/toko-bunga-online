<?php
session_start();
include '../koneksi.php';

// cek login
if($_SESSION['status_login'] != true){
    header('location: ../login.php');
    exit();
}

// cek id pelanggan
if(isset($_GET['id'])){

    $id = $_GET['id'];

    $hapus = mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan = '$id'");

    if($hapus){
        echo "<script>
                alert('Data pelanggan berhasil dihapus');
                window.location='data_pelanggan.php';
              </script>";
    }else{
        echo "<script>
                alert('Gagal menghapus data');
                window.location='data_pelanggan.php';
              </script>";
    }

}else{
    header('location: data_pelanggan.php');
}
?>