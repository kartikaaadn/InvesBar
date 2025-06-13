<?php
session_start();
// Contoh data login
// $_SESSION['role'] = 'admin'; // atau 'user'
$role = $_SESSION['role'] ?? 'user'; // fallback default user
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Assetify - <?= ucfirst($role) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            poppins: ['Poppins', 'sans-serif']
          },
          colors: {
            pinklight: '#ffe0f4',
            pinkmain: '#FFBAED',
            pinkhover: '#f7aee0'
          }
        }
      }
    }
  </script>
</head>
<body class="font-poppins bg-pinklight">

<!-- HEADER -->
<header class="bg-white shadow-md p-4 flex justify-between items-center">
  <div class="flex items-center space-x-4">
    <img src="Photo/logo.png" alt="Assetify Logo" class="h-10">
    <nav class="space-x-6 text-gray-600 font-medium">
      <?php if ($role === 'admin'): ?>
        <a href="#" class="hover:text-pink-400">Dashboard</a>
        <a href="admin/barang.php" class="hover:text-pink-400">Data Barang</a>
        <a href="admin/data-peminjaman.php" class="hover:text-pink-400">Data Peminjam</a>
        <a href="admin/admin_riwayat.php" class="hover:text-pink-400">Riwayat</a>
      <?php else: ?>
        <a href="#" class="hover:text-pink-400">Dashboard</a>
        <a href="#" class="hover:text-pink-400">Data Barang</a>
        <a href="#" class="hover:text-pink-400">Form Pengajuan</a>
        <a href="#" class="hover:text-pink-400">Riwayat Peminjaman</a>
      <?php endif; ?>
    </nav>
  </div>
  <div class="flex items-center space-x-4">
    <span class="text-gray-700">Selamat datang, <?= $_SESSION['nama'] ?? 'Pengguna' ?>!</span>
    <a href="#">
      <button class="bg-pinkmain hover:bg-pinkhover text-gray-800 px-4 py-2 rounded font-semibold transition">
        Logout
      </button>
    </a>
  </div>
</header>
