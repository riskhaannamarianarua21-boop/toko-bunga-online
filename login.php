<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Toko Bunga</title>
    <link rel="stylesheet" href="style.css?v=1">
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
                <input type="password" name="password" placeholder="Masukkan password" required>

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

</body>
</html>