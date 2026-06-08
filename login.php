<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Toko Bunga</title>
    <link rel="stylesheet" href="style.css?v=20">
    
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="ico/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="ico/favicon-16x16.png">
    <link rel="manifest" href="ico/site.webmanifest">
</head>
<body>

<header>

    <div class="logo">
        <div class="flower">✿</div>

        <div>
            <h2>Toko Bunga</h2>
            <p>Bunga Indah, Momen Berkesan</p>
        </div>
    </div>

    <nav>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="anggota.php">Anggota</a>
    </nav>

</header>

<main>
    <div class="card">

        <div class="left">
            <h1>Selamat Datang</h1>
            <div class="garis"></div>
            <p>Login untuk melanjutkan belanja bunga indah di Toko Bunga.</p>

            <img src="bunga.jpg" alt="Bunga">
        </div>

        <div class="right">
            <form action="proses_login.php" method="POST">

                <h2>Login Akun</h2>

                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>

                <label>Password</label>

<div class="password-box">
    <input type="password"
           id="loginPassword"
           name="password"
           placeholder="Masukkan password"
           required>

    <span class="toggle-password"
          onclick="toggleLoginPassword()">👁</span>
</div>

                <button type="submit" class="btn">Login</button>

                <div class="atau">
                    <span></span>
                    <p>atau</p>
                    <span></span>
                </div>

                <p class="login">
                    Belum punya akun? <a href="register.php">Daftar di sini</a>
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

<script>
function toggleLoginPassword() {

    const password =
    document.getElementById("loginPassword");

    if(password.type === "password"){

        password.type = "text";

    }else{

        password.type = "password";

    }
}
</script>
    
</body>
</html>