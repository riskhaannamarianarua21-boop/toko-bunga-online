<?php
include "koneksi.php";

if (isset($_POST['register'])) {

    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $telephone = $_POST['telephone'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "INSERT INTO pelanggan 
    (nama_pelanggan, username, password, alamat, telephone)
    VALUES 
    ('$nama_pelanggan', '$username', '$password', '$alamat', '$telephone')");

    if ($query) {
        echo "<script>
            alert('Registrasi berhasil');
            window.location='login.php';
        </script>";
    } else {
        echo "<script>
            alert('Registrasi gagal: " . mysqli_error($conn) . "');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register Toko Bunga</title>
    <link rel="stylesheet" href="register.css?v=2">
</head>

<script>
    function togglePassword() {
        var password = document.getElementById("password");

        if (password.type === "password") {
            password.type = "text";
        } else {
            password.type = "password";
        }
    }
</script>

<body>

    <header>
        <div class="logo">
            <div class="flower">✿</div>
            <div>
                <h2>Toko Bunga</h2>
                <p>Bunga Indah, Momen Berkesan</p>
            </div>
        </div>

    </header>

    <main>
        <div class="card">

            <div class="left">
                <h1>Buat Akun Baru</h1>
                <div class="garis"></div>
                <p>Daftarkan diri Anda untuk mulai berbelanja di Toko Bunga dan nikmati berbagai penawaran menarik.</p>

                <img src="bunga.jpg" alt="Bunga">
            </div>

            <div class="right">
                <form action="register.php" method="POST">

                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_pelanggan" placeholder="Masukkan nama lengkap" required>

                    <label>Alamat</label>
                    <textarea name="alamat" placeholder="Masukkan alamat lengkap" required></textarea>

                    <label>Nomor Telepon</label>
                    <input
                        type="text"
                        name="telephone"
                        placeholder="Masukkan nomor telepon"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        required>

                    <label>Username</label>
                    <input type="text" name="username" placeholder="Masukkan username" required>

                    <label>Password</label>

                    <div class="password-box">
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>

                        <span class="toggle-password" onclick="togglePassword()">
                            👁
                        </span>
                    </div>

                    <button type="submit" name="register" class="btn">Register</button>

                    <div class="atau">
                        <span></span>
                        <p>atau</p>
                        <span></span>
                    </div>

                    <p class="login">
                        Sudah punya akun? <a href="login.php">Login di sini</a>
                    </p>

                </form>
            </div>

        </div>
    </main>
    <footer>
        <p>📍 Jl. Pulau Sumetera(Bahu)</p>
        <p>📞 085344119767</p>
        <p>© 2026 Toko Bunga</p>
    </footer>

</body>

</html>