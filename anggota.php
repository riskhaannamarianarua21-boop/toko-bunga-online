<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota Kelompok</title>

    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="ico/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="ico/favicon-16x16.png">
    <link rel="manifest" href="ico/site.webmanifest">
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

main{
    flex:1;
}

        body{
    background: #fdf6f8;
    display: flex;
    flex-direction: column;
}

        header{
    height:70px;
    background:white;
    padding:0 70px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    box-shadow:0 3px 15px rgba(0,0,0,0.08);
}

.logo{
    display:flex;
    align-items:center;
    gap:8px;
}

.flower{
    font-size:34px;
    color:#d6336c;
}

.logo h2{
    color:#9b174c;
    font-size:24px;
}

.logo p{
    font-size:12px;
    color:#666;
}

        nav a{
            text-decoration:none;
            margin-left:20px;
            color:#333;
            font-weight:bold;
        }

        .hero{
    background:#f9e7ee;
    text-align:center;
    padding:35px 15px;
}

        .hero h1{
    color:#c2185b;
    font-size:42px;
    margin-bottom:10px;
}

        .hero p{
    color:#555;
    font-size:15px;
}

html, body{
    margin: 0;
    padding: 0;
    min-height: 100vh;
}

        .anggota-container{
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:35px;
    padding:50px 50px 90px;
    flex:1;
}

        .anggota-card{
            width:280px;
            background:white;
            border-radius:20px;
            padding:25px;
            text-align:center;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
            transition:0.3s;
        }

        .anggota-card:hover{
            transform:translateY(-10px);
        }

        .foto-anggota{
            width:120px !important;
            height:120px !important;
            max-width:120px !important;
            border-radius:50%;
            object-fit:cover;
            border:5px solid #e91e63;
            padding:4px;
            background:white;
            display:block;
            margin:0 auto 15px auto;
            box-shadow:0 5px 15px rgba(233,30,99,0.3);
        }

        .anggota-card h3{
            color:#c2185b;
            font-size:22px;
            margin-bottom:10px;
        }

        .anggota-card p{
            margin:8px 0;
            color:#444;
        }


        footer{
    background: #c2185b;
    color: white;
    text-align: center;
    padding: 15px;
    margin-top: auto;
}

        /* Tablet */
@media (max-width: 768px){

    header{
        flex-direction:column;
        gap:15px;
        padding:20px;
        text-align:center;
    }

    nav{
        display:flex;
        flex-wrap:wrap;
        justify-content:center;
        gap:10px;
    }

    nav a{
        margin-left:0;
    }

    .hero h1{
        font-size:38px;
    }

    .hero p{
        font-size:16px;
    }

    .anggota-container{
        padding:30px 15px;
    }

    .anggota-card{
        width:100%;
        max-width:350px;
    }
}

/* HP */
@media (max-width: 480px){

    header{
        padding:15px;
    }

    .logo{
        flex-direction:column;
        text-align:center;
    }

    .flower{
        font-size:30px;
    }

    .hero{
        padding:50px 15px;
    }

    .hero h1{
        font-size:30px;
    }

    .hero p{
        font-size:14px;
    }

   .anggota-card{
    width:100%;
    max-width:280px;
}
    .foto-anggota{
        width:100px !important;
        height:100px !important;
        max-width:100px !important;
    }

    .anggota-card h3{
        font-size:18px;
    }

    footer{
        font-size:14px;
    }
}
    </style>
</head>
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

<section class="hero">
    <h1>Anggota Kelompok</h1>
    <p>Berikut adalah anggota kelompok dalam pembuatan website Toko Bunga Online.</p>
</section>

<main>
   <div class="anggota-container">

    <div class="anggota-card">
        <img src="assets/img/riskha.jpeg" class="foto-anggota">
        <h3>Riskha Anna Maria Narua</h3>
        <p><strong>NIM</strong><br>240211060120</p>
    </div>

    <div class="anggota-card">
        <img src="assets/img/gracia.jpeg" class="foto-anggota">
        <h3>Gracia Eka Putri Samino</h3>
        <p><strong>NIM</strong><br>240211060038</p>
    </div>

    <div class="anggota-card">
        <img src="assets/img/ulandsy.jpeg" class="foto-anggota">
        <h3>Ulandsy Chanfelzia Sohilait</h3>
        <p><strong>NIM</strong><br>240211060058</p>
    </div>

    <div class="anggota-card">
        <img src="assets/img/julia.jpeg" class="foto-anggota">
        <h3>Julia Angela Epifania Sondakh</h3>
        <p><strong>NIM</strong><br>240211060091</p>
    </div>

</div>
</main>

<footer>
    <p>© 2026 Toko Bunga Online</p>
</footer>

</body>
</html>