<?php 
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM barang");
?>

<?php include_once "../includes/header.php"; ?>

<div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow-xl mt-6">
  <h2 class="text-2xl font-bold text-purple-700 mb-4">📦 Data Barang Inventaris</h2>
  <a href="tambah-barang.php" class="bg-purple-600 text-white px-4 py-2 rounded shadow hover:bg-purple-700 transition mb-4 inline-block">+ Tambah Barang</a>

  <div class="overflow-x-auto">
    <table class="w-full table-auto border text-sm">
      <thead class="bg-purple-200 text-purple-800">
        <tr>
          <th class="px-4 py-2 border">No</th>
          <th class="px-4 py-2 border">Kode</th>
          <th class="px-4 py-2 border">Nama</th>
          <th class="px-4 py-2 border">Jenis</th>
          <th class="px-4 py-2 border">Lokasi</th>
          <th class="px-4 py-2 border">Kondisi</th>
          <th class="px-4 py-2 border">Stok</th>
          <th class="px-4 py-2 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($query)) : ?>
        <tr class="text-center">
          <td class="border px-4 py-2"><?= $no++ ?></td>
          <td class="border px-4 py-2"><?= htmlspecialchars($row['kode_barang']) ?></td>
          <td class="border px-4 py-2"><?= htmlspecialchars($row['nama_barang']) ?></td>
          <td class="border px-4 py-2"><?= htmlspecialchars($row['jenis']) ?></td>
          <td class="border px-4 py-2"><?= htmlspecialchars($row['lokasi']) ?></td>
          <td class="border px-4 py-2"><?= ucfirst($row['kondisi']) ?></td>
          <td class="border px-4 py-2"><?= $row['stok'] ?></td>
          <td class="border px-4 py-2 space-x-2">
            <a href="edit-barang.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
            <a href="hapus-barang.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus barang ini?')" class="text-red-600 hover:underline">Hapus</a>
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
