<?php
session_start();
require_once "../includes/db.php";

// Cek login admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Ambil semua data peminjaman
$query = mysqli_query($conn, "
    SELECT p.*, b.nama_barang, u.username AS nama_staf
    FROM peminjaman p
    JOIN barang b ON p.id_barang = b.id
    JOIN users u ON p.id_user = u.id
    ORDER BY p.tanggal_pinjam DESC
");
?>

<?php include_once "../includes/header.php"; ?>

<div class="max-w-6xl mx-auto mt-6">
  <h1 class="text-3xl font-bold text-purple-700 mb-6">📦 Data Peminjaman Barang</h1>

  <div class="overflow-x-auto bg-white shadow rounded-xl">
    <table class="min-w-full text-sm text-gray-700">
      <thead class="bg-purple-200 text-purple-800">
        <tr>
          <th class="px-4 py-2">No</th>
          <th class="px-4 py-2">Staf</th>
          <th class="px-4 py-2">Barang</th>
          <th class="px-4 py-2">Jumlah</th>
          <th class="px-4 py-2">Tgl Pinjam</th>
          <th class="px-4 py-2">Tgl Kembali</th>
          <th class="px-4 py-2">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
        <tr class="border-t text-center">
          <td class="px-4 py-2"><?= $no++ ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($row['nama_staf']) ?></td>
          <td class="px-4 py-2"><?= htmlspecialchars($row['nama_barang']) ?></td>
          <td class="px-4 py-2"><?= $row['jumlah'] ?></td>
          <td class="px-4 py-2"><?= $row['tanggal_pinjam'] ?></td>
          <td class="px-4 py-2"><?= $row['tanggal_kembali'] ?? '-' ?></td>
          <td class="px-4 py-2">
            <?php if ($row['status'] === 'dipinjam'): ?>
              <span class="text-yellow-600 font-semibold">Dipinjam</span>
            <?php else: ?>
              <span class="text-green-600 font-semibold">Dikembalikan</span>
            <?php endif; ?>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <a href="dashboard.php" class="mt-6 inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
    ← Kembali ke Dashboard
  </a>
</div>

<?php include_once "../includes/footer.php"; ?>