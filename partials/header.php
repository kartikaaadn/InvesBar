<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komponen Header</title>

    <style>
        /* CSS yang dibutuhkan HANYA untuk styling header */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        /* Reset dasar */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #f0f0f0; /* Latar belakang abu-abu untuk demo */
        }
        
        /* Styling untuk Header */
        .app-header {
            background-color: #ffffff;
            padding: 0 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .header-logo img {
            height: 40px;
            width: auto;
        }

        .header-nav a {
            color: #555;
            text-decoration: none;
            margin: 0 1rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .header-nav a:hover, .header-nav a.active {
            color: #FFBAED;
        }

        .header-user {
            display: flex;
            align-items: center;
        }
        
        .header-user span {
            margin-right: 1rem;
        }

        .logout-btn {
            background-color: #FFBAED;
            color: #333;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .logout-btn:hover {
            background-color: #f7aee0;
        }
    </style>
</head>

<body>

    <header class="app-header">
        <div class="header-logo">
            <a href="#">
                <img src="Photo/logo.png" alt="Assetify Logo">
            </a>
        </div>

        <nav class="header-nav">
            <a href="#" class="active">Dashboard</a>
            <a href="#">Daftar Barang</a>
            <a href="#">Tambah Barang</a>
            <a href="#">Laporan</a>
        </nav>

        <div class="header-user">
            <span>Selamat datang, Cici!</span>
            <a href="#"><button class="logout-btn">Logout</button></a>
        </div>
    </header>

    <div style="padding: 2rem;">
        <p>Ini adalah halaman <strong>header.html</strong> yang dijalankan secara mandiri.</p>
        <p>Konten halaman utama (seperti dashboard) tidak ada di sini.</p>
    </div>

</body>
</html>