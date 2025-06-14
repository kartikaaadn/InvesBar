<?php
session_start();
require_once "../includes/db.php";

// Cek login & role admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Ambil data ringkasan
$total_barang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM barang"))['total'];
$total_peminjaman = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM peminjaman"))['total'];
$barang_dipinjam = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT id_barang) AS total FROM peminjaman WHERE status = 'dipinjam'"))['total'];
$jumlah_dipinjam = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM peminjaman WHERE status = 'dipinjam'"))['total'] ?? 0;

include_once "../includes/header.php";
?>

<div class="max-w-7xl mx-auto">
  <h1 class="text-3xl font-bold text-purple-700 mb-6">👩‍💼 Dashboard Admin</h1>

  <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-purple-400">
      <h2 class="text-xl font-semibold text-gray-700">Total Barang</h2>
      <p class="text-4xl font-bold text-purple-600 mt-2"><?= $total_barang ?></p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-pink-400">
      <h2 class="text-xl font-semibold text-gray-700">Barang Dipinjam</h2>
      <p class="text-4xl font-bold text-pink-600 mt-2"><?= $barang_dipinjam ?></p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-yellow-400">
      <h2 class="text-xl font-semibold text-gray-700">Unit Dipinjam</h2>
      <p class="text-4xl font-bold text-yellow-600 mt-2"><?= $jumlah_dipinjam ?></p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-indigo-400">
      <h2 class="text-xl font-semibold text-gray-700">Total Peminjaman</h2>
      <p class="text-4xl font-bold text-indigo-600 mt-2"><?= $total_peminjaman ?></p>
    </div>
  </div>

  <div class="mt-10">
    <a href="barang.php" class="bg-purple-600 text-white px-5 py-2 rounded hover:bg-purple-700 transition">Kelola Barang</a>
    <a href="peminjaman.php" class="ml-4 bg-pink-600 text-white px-5 py-2 rounded hover:bg-pink-700 transition">Lihat Peminjaman</a>
  </div>
</div>

<?php include_once "../includes/footer.php"; ?>