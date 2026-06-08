<?php 
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

// CEK PELANGGAN
$q = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username='$username'");
$r = mysqli_fetch_assoc($q);

// CEK PETUGAS
$q2 = mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username'");
$row = mysqli_fetch_assoc($q2);

// LOGIN PELANGGAN
if ($r && password_verify($password, $r['password'])) {

    $_SESSION['id_pelanggan'] = $r['id_pelanggan'];
    $_SESSION['nama_pelanggan'] = $r['nama_pelanggan'];
    $_SESSION['username'] = $r['username'];
    $_SESSION['status_login'] = true;

    header('location:./Pelanggan/index.php');
    exit;
}

// LOGIN PETUGAS
elseif ($row && password_verify($password, $row['password'])) {

    $_SESSION['id_petugas'] = $row['id_petugas'];
    $_SESSION['nama_petugas'] = $row['nama_petugas'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['status_login'] = true;

    header('location:./Petugas/index.php');
    exit;
}

// JIKA GAGAL
else {
    echo "<script>
        alert('Username dan Password tidak benar');
        location.href='login.php';
    </script>";
}
?>