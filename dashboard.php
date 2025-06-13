<?php
session_start();
$_SESSION['role'] = 'admin'; // sementara untuk tes (nanti diganti saat login)
$role = $_SESSION['role'] ?? null; // Tambahkan ini agar tidak undefined
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Assetify</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    * {
      margin: 0; padding: 0; box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f7f6;
      color: #333;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .app-header {
      background-color: #ffffff;
      padding: 0 2rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
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

    .header-nav a:hover,
    .header-nav a.active {
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

    .app-main {
      flex-grow: 1;
      padding: 2rem;
    }

    .main-content {
      background-color: #ffffff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .main-content h1 {
      margin-bottom: 1rem;
    }

    .app-footer {
      background-color: #333;
      color: #f4f7f6;
      text-align: center;
      padding: 1.5rem;
      margin-top: auto;
    }
  </style>
</head>

<body>

  <!-- HEADER -->
  <header class="app-header">
    <div class="header-logo">
      <a href="dashboard.php">
        <img src="Photo/logo.png" alt="Assetify Logo" />
      </a>
    </div>

    <nav class="header-nav">
      <a href="dashboard.php" class="active">Dashboard</a>
      <a href="admin/barang.php">Daftar Barang</a>
      <?php if ($role === 'admin'): ?>
        <a href="admin/data-peminjaman.php">Data Peminjaman</a>
      <?php else: ?>
        <a href="form-pengajuan.php">Form Pengajuan</a>
      <?php endif; ?>
      <a href="admin-riwayat.html">Riwayat</a>
    </nav>

    <div class="header-user">
      <span>Selamat datang, <?= $role === 'admin' ? 'Admin' : 'Cici'; ?>!</span>
      <a href="logout.php"><button class="logout-btn">Logout</button></a>
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <main class="app-main">
    <div class="main-content">
      <h1>Selamat Datang di Dashboard</h1>
      <?php if ($role === 'admin'): ?>
        <p>Ini adalah halaman utama Admin. Anda bisa mengelola semua aset kantor, termasuk data peminjaman dan daftar barang.</p>
      <?php else: ?>
        <p>Ini adalah halaman utama User. Anda bisa melihat daftar barang, mengajukan peminjaman, dan melihat riwayat Anda.</p>
      <?php endif; ?>
    </div>
  </main>

  <!-- FOOTER -->
  <footer class="app-footer">
    <p>&copy; <span id="currentYear"></span> Assetify. All Rights Reserved.</p>
  </footer>

  <script>
    document.getElementById('currentYear').textContent = new Date().getFullYear();
  </script>

</body>
</html>
