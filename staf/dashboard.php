<?php
session_start();
require_once "../includes/db.php";

// Cek login staf
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staf') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['user_id'];

// Ambil total peminjaman staf ini
$total_pinjam = mysqli_fetch_assoc(mysqli_query($conn, 
  "SELECT COUNT(*) AS total FROM peminjaman WHERE id_user = $id_user"))['total'];

// Ambil total barang yang sedang dipinjam
$dipinjam = mysqli_fetch_assoc(mysqli_query($conn, 
  "SELECT SUM(jumlah) AS total FROM peminjaman WHERE id_user = $id_user AND status = 'dipinjam'"))['total'] ?? 0;

include_once "../includes/header.php";
?>

<div class="max-w-4xl mx-auto">
  <h1 class="text-3xl font-bold text-purple-700 mb-6">📋 Dashboard Staf</h1>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Total Riwayat -->
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-purple-400">
      <h2 class="text-xl font-semibold text-gray-700">Total Riwayat Peminjaman</h2>
      <p class="text-3xl text-purple-600 mt-2"><?= $total_pinjam ?></p>
    </div>

    <!-- Barang Sedang Dipinjam -->
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-pink-400">
      <h2 class="text-xl font-semibold text-gray-700">Sedang Dipinjam</h2>
      <p class="text-3xl text-pink-600 mt-2"><?= $dipinjam ?></p>
    </div>
  </div>

  <div class="mt-8">
    <a href="pinjam.php" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">+ Pinjam Barang</a>
    <a href="status.php" class="ml-4 bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">📄 Status Peminjaman</a>
  </div>
</div>

<?php include_once "../includes/footer.php"; ?>
